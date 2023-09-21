<?php

namespace Codedor\FilamentArchitect\Filament\Resources;

use Codedor\FilamentArchitect\Models\ArchitectTemplate;
use Codedor\FilamentArchitect\Filament\Fields\Architect;
use Codedor\FilamentArchitect\Filament\Resources\ArchitectTemplateResource\Pages;
use Codedor\FilamentArchitect\Filament\Resources\ArchitectTemplateResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArchitectTemplateResource extends Resource
{
    protected static ?string $model = ArchitectTemplate::class;

    protected static ?string $navigationGroup = 'Architect';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true),

                Architect::make('body'),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
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
