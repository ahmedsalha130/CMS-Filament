<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?int $navigationSort = 7;
    public static function getGloballySearchableAttributes(): array
    {
        return ['name_ar', 'name_en'];
    }


    public static function getNavigationLabel(): string
    {
        return __('dashboard.services');
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 4 ? 'warning' : 'primary';
    }




    public static function getModelLabel(): string
    {
        return __('dashboard.service');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.services');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name_ar')->label(__('dashboard.name_ar'))->required(),
                TextInput::make('name_en')->label(__('dashboard.name_en'))->required(),
                TextInput::make('icon')->label(__('dashboard.icon')),
                Textarea::make('description_ar')->label(__('dashboard.description_ar')),
                Textarea::make('description_en')->label(__('dashboard.description_en')),
                FileUpload::make('image')->label(__('dashboard.image')),
                TextInput::make('link')->label(__('dashboard.link'))->url(),
                TextInput::make('order')->label(__('dashboard.order'))->numeric(),
                Toggle::make('is_active')->default(true)->label(__('dashboard.is_active'))->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('dashboard.name'))
                    ->getStateUsing(fn($record) => app()->getLocale() === 'ar' ? $record->name_ar : $record->name_en),
                Tables\Columns\TextColumn::make('icon')->label(__('dashboard.icon')),
                Tables\Columns\ImageColumn::make('image')->label(__('dashboard.image')),
                Tables\Columns\TextColumn::make('order')->label(__('dashboard.order')),
                Tables\Columns\BooleanColumn::make('is_active')->label(__('dashboard.is_active')),
            ])

            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->label(__('dashboard.is_active'))
                    ->options([
                        true => __('dashboard.yes'),
                        false => __('dashboard.no'),
                    ]),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListServices::route('/'),
//            'create' => Pages\CreateService::route('/create'),
//            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
