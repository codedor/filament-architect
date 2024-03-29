<?php

namespace Codedor\FilamentArchitect\Filament\Resources;

use Codedor\FilamentArchitect\Filament\Fields\ArchitectInput;
use Codedor\FilamentArchitect\Filament\Fields\PageArchitectInput;
use Codedor\FilamentArchitect\Filament\Resources\ArchitectTemplateResource\Pages;
use Codedor\FilamentArchitect\Models\ArchitectTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ArchitectTemplateResource extends Resource
{
    protected static ?string $model = ArchitectTemplate::class;

    protected static ?string $navigationGroup = 'Architect';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
