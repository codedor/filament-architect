<?php

namespace Codedor\FilamentArchitect\Filament\Fields;

use Closure;
use Codedor\FilamentArchitect\Facades\ArchitectConfig;
use Codedor\FilamentArchitect\Filament\Architect\BaseBlock;
use Codedor\FilamentArchitect\Models\ArchitectTemplate;
use Codedor\LocaleCollection\Facades\LocaleCollection;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Support\Enums\ActionSize;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ArchitectInput extends Field
{
    protected string $view = 'filament-architect::architect-input';

    public null|Closure|iterable $blocks = null;
    public Closure|iterable $excludedBlocks = [];
    public Closure|iterable $extraBlocks = [];

    public null|Closure|iterable $locales = null;

    public null|int|Closure $maxFieldsPerRow = 1;

    public Closure|bool $hasTemplates = true;
    public Closure|bool $hasPreview = true;

    protected function setUp(): void
    {
        parent::setUp();

        $this->default([]);

        $this->registerActions([
            fn (self $component): Action => $component->getArchitectPreviewAction(),
            fn (self $component): Action => $component->getStartFromTemplateAction(),
            fn (self $component): Action => $component->getAddBlockAction(),
            fn (self $component): Action => $component->getAddBlockBetweenAction(),
            fn (self $component): Action => $component->getEditBlockAction(),
            fn (self $component): Action => $component->getDeleteBlockAction(),
        ]);

        $this->registerListeners([
            'filament-architect::editedBlock' => [
                function (self $component, string $statePath, array $arguments): void {
                    if ($statePath !== $component->getStatePath()) {
                        return;
                    }

                    $items = $component->getState();
                    $items[$arguments['row']][$arguments['uuid']]['data'] = $arguments['form']['state'];
                    $component->state($items);
                },
            ],
            'reorder-row' => [
                function (self $component, string $statePath, array $data): void {
                    if ($statePath !== $component->getStatePath()) {
                        return;
                    }

                    $items = $component->getState();

                    $items = collect($items)
                        ->sortBy(fn ($item, $key) => array_search($key, $data['newKeys']))
                        ->values()
                        ->toArray();

                    $component->state($items);
                },
            ],
            'reorder-column' => [
                function (self $component, string $statePath, array $data): void {
                    if ($statePath !== $component->getStatePath()) {
                        return;
                    }

                    $items = $component->getState();

                    $items[$data['row']] = collect($items[$data['row']])
                        ->sortBy(fn ($item, $key) => array_search($key, $data['newKeys']))
                        ->toArray();

                    $component->state($items);
                },
            ],
        ]);
    }

    public function getArchitectPreviewAction(): Action
    {
        return Action::make('architectPreview')
            ->icon('heroicon-o-eye')
            ->label("Preview {$this->getName()}")
            ->color('gray')
            ->size(ActionSize::Small)
            ->extraAttributes([
                'target' => '_blank',
                'class' => ! ArchitectConfig::getPreviewAction() ? 'hidden' : '',
            ])
            ->url(ArchitectConfig::getPreviewAction());
    }

    public function getStartFromTemplateAction(): Action
    {
        return Action::make('startFromTemplate')
            ->icon('heroicon-o-document-duplicate')
            ->label('Start from template')
            ->color('gray')
            ->size(ActionSize::Small)
            ->closeModalByClickingAway(false)
            ->form(fn () => [
                Select::make('block')
                    ->options(fn () => ArchitectTemplate::orderBy('name')->pluck('name', 'id'))
                    ->hiddenLabel()
                    ->required(),
            ])
            ->action(function (self $component, array $data) {
                $template = ArchitectTemplate::find($data['block']);

                $component->state($template->body ?? []);

                Notification::make()
                    ->title('The template has been loaded')
                    ->success()
                    ->send();
            });
    }

    public function getDeleteBlockAction(): Action
    {
        return Action::make('deleteBlock')
            ->icon('heroicon-o-trash')
            ->hiddenLabel()
            ->color('danger')
            ->size(ActionSize::Small)
            ->closeModalByClickingAway(false)
            ->requiresConfirmation()
            ->action(function (self $component, array $arguments) {
                $items = $component->getState();

                unset($items[$arguments['row']][$arguments['uuid']]);

                if (empty($items[$arguments['row']])) {
                    unset($items[$arguments['row']]);
                } else {
                    $items = $this->normalizeWidth($items);
                }

                $component->state(array_values($items));
            });
    }

    public function getEditBlockAction(): Action
    {
        return Action::make('editBlock')
            ->icon('heroicon-o-pencil')
            ->hiddenLabel()
            ->color('gray')
            ->size(ActionSize::Small)
            ->closeModalByClickingAway(false)
            ->modalSubmitAction(false)
            ->modalCancelAction(false)
            ->modalContent(fn (self $component) => view(
                'filament-architect::edit-modal',
                [
                    // TODO: This is a hack to get the arguments to the modal
                    // https://github.com/filamentphp/filament/issues/8763
                    'arguments' => Arr::last($this->getLivewire()->mountedFormComponentActionsArguments),
                    'statePath' => $component->getStatePath(),
                ]
            ));
    }

    public function getBaseAddBlockAction(string $name): Action
    {
        return Action::make($name)
            ->icon('heroicon-o-plus')
            ->hiddenLabel()
            ->color('gray')
            ->size(ActionSize::Small)
            ->closeModalByClickingAway(false)
            ->form(fn () => [
                Select::make('block')
                    ->options(fn () => collect($this->getBlocks())->map(fn ($b) => $b->getName()))
                    ->hiddenLabel()
                    ->required(),
            ]);
    }

    public function getAddBlockAction(): Action
    {
        return $this->getBaseAddBlockAction('addBlock')->action(function (self $component, array $arguments, array $data) {
            $newUuid = (string) Str::uuid();

            $items = $component->getState();
            $newBlock = $this->newBlock($data);

            // If the state is empty, add the new block to the start of the array
            if (empty($items)) {
                $items = [[$newUuid => $newBlock]];
                $component->state($items);

                return;
            }

            // Insert between the current row and the next one
            $items = array_merge(
                array_slice($items, 0, $arguments['row'] + 1),
                [[$newUuid => $newBlock]],
                array_slice($items, $arguments['row'] + 1),
            );

            $component->state($items);
        });
    }

    public function getAddBlockBetweenAction(): Action
    {
        return $this->getBaseAddBlockAction('addBlockBetween')->action(function (self $component, array $arguments, array $data) {
            $newUuid = (string) Str::uuid();

            $after = $arguments['insertAfter'] ?? null;
            $newBlock = $this->newBlock($data);
            $newBlock['width'] = 12;

            // Insert between the current column and the next one
            if ($after) {
                $items = [];
                foreach ($component->getState() as $rowKey => $row) {
                    foreach ($row as $uuid => $item) {
                        $items[$rowKey][$uuid] = $item;

                        if ($uuid === $after) {
                            $items[$rowKey][$newUuid] = $newBlock;
                        }
                    }
                }
            } else {
                // Add the new block to the start of the row array
                $items = $component->getState();

                $items[$arguments['row']] = array_merge(
                    [$newUuid => $newBlock],
                    $items[$arguments['row']],
                );
            }

            $items = $this->normalizeWidth($items);

            $component->state($items);
        });
    }

    public function maxFieldsPerRow(null|int|Closure $maxFieldsPerRow): static
    {
        $this->maxFieldsPerRow = $maxFieldsPerRow;

        return $this;
    }

    public function getMaxFieldsPerRow(): int
    {
        return $this->evaluate($this->maxFieldsPerRow) ?? 12;
    }

    public function blocks(null|Closure|iterable $blocks): static
    {
        $this->blocks = $blocks;

        return $this;
    }

    public function excludedBlocks(Closure|iterable $excludedBlocks): static
    {
        $this->excludedBlocks = $excludedBlocks;

        return $this;
    }

    public function extraBlocks(Closure|iterable $extraBlocks): static
    {
        $this->extraBlocks = $extraBlocks;

        return $this;
    }

    public function getBlocks(): Collection
    {
        $excludedBlocks = Collection::wrap($this->evaluate($this->excludedBlocks))
            ->map(fn ($b) => get_class($b))
            ->toArray();

        return Collection::wrap($this->evaluate($this->blocks))
            ->merge($this->evaluate($this->extraBlocks))
            ->reject(fn (BaseBlock $block) => in_array(get_class($block), $excludedBlocks))
            ->sortBy(fn (BaseBlock $block) => $block->getName())
            ->values();
    }

    public function locales(null|Closure|iterable $locales): static
    {
        $this->locales = $locales;

        return $this;
    }

    public function getLocales(): array
    {
        return $this->evaluate($this->locales)
            ?? LocaleCollection::map(fn ($locale) => $locale->locale())->toArray();
    }

    public function hasTemplates(Closure|bool $hasTemplates): static
    {
        $this->hasTemplates = $hasTemplates;

        return $this;
    }

    public function getHasTemplates(): bool
    {
        return $this->evaluate($this->hasTemplates);
    }

    public function hasPreview(Closure|bool $hasPreview): static
    {
        $this->hasPreview = $hasPreview;

        return $this;
    }

    public function getHasPreview(): bool
    {
        return $this->evaluate($this->hasPreview);
    }

    private function newBlock(array $data)
    {
        return [
            'type' => class_basename($this->getBlocks()[$data['block']]),
            'width' => 12,
            'data' => [],
        ];
    }

    private function normalizeWidth(array $items)
    {
        foreach ($items as $key => $row) {
            $totalWidth = collect($row)->sum('width');

            if ($totalWidth === 12) {
                continue;
            }

            foreach (array_keys($row) as $uuid) {
                $items[$key][$uuid]['width'] = 12 / count($row);
            }
        }

        return $items;
    }
}
