<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?int $navigationSort = 2;
    public static function getGloballySearchableAttributes(): array
    {
        return ['name_ar', 'name_en'];
    }


    public static function getNavigationLabel(): string
    {
        return __('dashboard.categories');
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'warning' : 'primary';
    }




    public static function getModelLabel(): string
    {
        return __('dashboard.category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.categories');
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
                Forms\Components\Select::make('parent_id')
                    ->label(__('dashboard.parent_category'))
                    ->helperText(new HtmlString('<span style="color: red;">' . __('dashboard.category_not_select') . '</span>'))
                    ->hintIcon('heroicon-o-information-circle') // اختياري لإضافة أيقونة
                    ->relationship('parent', 'name_ar') // Fixed the relationship to correctly reference 'name_ar'
                    ->searchable()
                    ->preload(true),
                Forms\Components\FileUpload::make('image')
                    ->label(__('dashboard.image'))
                    ->directory('categories')
                    ->image(),
                Forms\Components\Toggle::make('is_active')
                    ->label(__( 'dashboard.is_active'))
                    ->default(true),
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
                Tables\Columns\TextColumn::make('parent.name')
                    ->label(__('dashboard.parent_category'))
                    ->getStateUsing(fn($record) => app()->getLocale() === 'ar' ? $record->parent->name_ar ?? __('dashboard.parent') : $record->parent->name_en ?? __('dashboard.parent')),

                Tables\Columns\ImageColumn::make('image')
                    ->label(__('dashboard.image')),
                Tables\Columns\BooleanColumn::make('is_active')
                    ->label(__('dashboard.is_active')),

            ])
            ->filters([

                Tables\Filters\Filter::make('is_active')
                    ->label(__('dashboard.is_active'))
                    ->query(fn(Builder $query): Builder => $query->where('is_active', true)),
                Tables\Filters\SelectFilter::make('parent_id')
                    ->label(__('dashboard.parent_category'))
                    ->relationship('parent', 'name_ar')
                    ->placeholder(__('dashboard.all_categories')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make('View'),
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
            'index' => Pages\ListCategories::route('/'),
//            'create' => Pages\CreateCategory::route('/create'),
//            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
