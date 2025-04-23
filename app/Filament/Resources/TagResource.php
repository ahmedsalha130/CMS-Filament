<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagResource\Pages;
use App\Filament\Resources\TagResource\RelationManagers;
use App\Models\Tag;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?int $navigationSort =3;

    public static function getNavigationLabel(): string
    {
        return __('dashboard.tags');
    }
    public static function getModelLabel(): string
    {
        return __('dashboard.tag');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.tags');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name_ar', 'name_en'];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name_ar')
                    ->label(__('dashboard.name_ar'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_en')
                    ->label(__('dashboard.name_en'))
                    ->required()
                    ->maxLength(255),
                Toggle::make('is_active')->label(__('dashboard.is_active'))->default(true),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('dashboard.name'))
                    ->getStateUsing(fn($record) => app()->getLocale() === 'ar' ? $record->name_ar : $record->name_en)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('is_active')->label(__('dashboard.is_active')),
            ])
            ->filters([

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label(__('dashboard.is_active')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
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
            'index' => Pages\ListTags::route('/'),
//            'create' => Pages\CreateTag::route('/create'),
//            'edit' => Pages\EditTag::route('/{record}/edit'),
        ];
    }
}
