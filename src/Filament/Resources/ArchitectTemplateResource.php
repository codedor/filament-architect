<?php

namespace Wotz\FilamentArchitect\Filament\Resources;

use Wotz\FilamentArchitect\Filament\Fields\ArchitectInput;
use Wotz\FilamentArchitect\Filament\Fields\PageArchitectInput;
use Wotz\FilamentArchitect\Filament\Resources\ArchitectTemplateResource\Pages;
use Wotz\FilamentArchitect\Models\ArchitectTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ArchitectTemplateResource extends Resource
{
    protected static ?string $model = ArchitectTemplate::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Architect';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true),

                PageArchitectInput::make('body'),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArchitectTemplates::route('/'),
            'create' => Pages\CreateArchitectTemplate::route('/create'),
            'edit' => Pages\EditArchitectTemplate::route('/{record}/edit'),
        ];
    }
}
