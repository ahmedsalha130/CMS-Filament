<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use TomatoPHP\FilamentMediaManager\Form\MediaManagerInput;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'warning' : 'primary';
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['title_ar' ,'title_en' ,'slug_ar','slug_en','content_ar','content_en','owner.name','categories.name_ar','categories.name_en','tags.name_ar','tags.name_en'];
    }
    public static function getNavigationBadge(): ?string
    {
        return (string)static::getModel()::count();
    }

    public static function getNavigationLabel(): string
    {
        return __('dashboard.posts');
    }


    public static function getModelLabel(): string
    {
        return __('dashboard.post');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.posts');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                TextInput::make('title_ar')
                    ->label(__('dashboard.title_ar'))
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (callable $set, $state) {
                        $slug = preg_replace('/[^أ-يa-zA-Z0-9\s]+/u', '', $state);
                        $slug = preg_replace('/[\s\-]+/u', '-', trim($slug));
                        $set('slug_ar', mb_strtolower($slug, 'UTF-8'));
                    })
                    ->maxLength(255),

                TextInput::make('slug_ar')
                    ->label(__('dashboard.slug_ar'))
                    ->unique(Post::class, 'slug_ar', ignoreRecord: true)
                    ->required()
                    ->readOnly() // You can make this editable if needed
                    ->maxLength(255)
                    ->lazy()
// ⚠️ Optional: remove this if slug is already being set correctly
//->dehydrateStateUsing(fn ($state) => Str::slug($state))
                ,

                TextInput::make('title_en')
                    ->label(__('dashboard.title_en'))
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(callable $set, $state) => $set('slug_en', Str::slug($state)))
                    ->maxLength(255),

                TextInput::make('slug_en')
                    ->label(__('dashboard.slug_en'))
                    ->unique(Post::class, 'slug_en', ignoreRecord: true)
                    ->required()
                    ->readOnly()
                    ->maxLength(255)
                    ->lazy()
//->dehydrateStateUsing(fn ($state) => Str::slug($state)) // Optional, depending on how slug is set
                ,
                RichEditor::make('content_ar')
                    ->label(__('dashboard.content_ar'))
                    ->required()
                    ->disableAllToolbarButtons(false)
                    ->columnSpan('full'),
                RichEditor::make('content_en')
                    ->label(__('dashboard.content_en'))
                    ->required()
                    ->disableAllToolbarButtons(false)
                    ->columnSpan('full'),

                Select::make('categories')
                    ->label(__('dashboard.categories'))
                    ->relationship('categories', app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', function (Builder $query) {
                        $query->where('is_active', true);
                    })
                    ->multiple()
                    ->required()
                    ->preload()
                    ->searchable(),

                Select::make('tags')
                    ->label(__('dashboard.tags'))
                    ->relationship('tags', app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', function (Builder $query) {
                        $query->where('is_active', true);
                    })
                    ->multiple()
                    ->required()
                    ->preload()
                    ->searchable(),
                Select::make('owner_id')
                    ->label(__('dashboard.owner'))
                    ->searchable()
                    ->preload()
                    ->relationship('owner', 'name')
                    ->required(),
                Toggle::make('is_active')
                    ->label(__('dashboard.is_active'))
                    ->default(true),


                MediaManagerInput::make('main_image')
                    ->disk('public')
                    ->columnSpan('full')
                    ->required()


            ->schema([
//                        Forms\Components\TextInput::make('title')
//                            ->required()
//                            ->maxLength(255),
//                        Forms\Components\TextInput::make('description')
//                            ->required()
//                            ->maxLength(255),
                    ]),
            // main images
//                SpatieMediaLibraryFileUpload::make('main_image')
//                    ->collection('main_image')
//                    ->directory('posts/main_image')
//                    ->columnSpan('full')
//                    ->preserveFilenames() // Optional: keep original file name
//                    ->getUploadedFileNameForStorageUsing(function ($file) {
//                        return Str::slug(request('title_en')) . '-' . time() . '.' . $file->getClientOriginalExtension();
//                    }),

                SpatieMediaLibraryFileUpload::make('images')
                    ->label(__('dashboard.images'))
                    ->collection('images')
                    ->multiple()
                    ->directory('posts/images')
                    ->columnSpan('full'),


            ]);



    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(fn (Post $record) => static::getUrl('view', ['record' => $record]))

            ->columns([
                //
                Tables\Columns\TextColumn::make('title')
                    ->label(__('dashboard.title'))
                    ->getStateUsing(fn($record) => Str::limit(app()->getLocale() === 'ar' ? $record->title_ar : $record->title_en, 20))
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where(function ($subQuery) use ($search) {
                            $subQuery->where('title_ar', 'like', "%{$search}%")
                                ->orWhere('title_en', 'like', "%{$search}%");
                        });
                    })
                    ,

                Tables\Columns\ImageColumn::make('main_image')
                    ->label(__('dashboard.main_image'))
                    ->getStateUsing(fn($record) => $record->getFirstMediaUrl('main_image'))
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('owner.name')
                    ->label(__('dashboard.owner'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(),


                Tables\Columns\TextColumn::make('comments_count')
                    ->label(__('dashboard.comments'))
                    ->counts('comments') // Count the comments relationship
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->icon('heroicon-o-chat-bubble-left-ellipsis') // Add an icon
                    ->url(fn($record) => route('filament.admin.resources.comments.index', ['tableFilters[post_id][value]' => $record->id])), // Redirect to the comments list with a filter on this post

                Tables\Columns\TextColumn::make('views')
                    ->label(__('dashboard.views'))
                    ->sortable()
                    ->icon('heroicon-o-eye'),

                Tables\Columns\TextColumn::make('likes_count')
                    ->label(__('dashboard.likes'))
                    ->counts('likes')
                    ->sortable()
                    ->toggleable()
                    ->icon('heroicon-o-heart'),

                Tables\Columns\BooleanColumn::make('is_active')
                    ->label(__('dashboard.is_active'))
                    ->sortable()
                     ->toggleable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label(__('dashboard.is_active'))
                    ->sortable()
                     ->toggleable(),

            ])
            ->filters([

                Tables\Filters\Filter::make('is_active')
                    ->label(__('dashboard.is_active'))
                    ->query(fn(Builder $query): Builder => $query->where('is_active', true)),

                Tables\Filters\SelectFilter::make('owner_id')
                    ->label(__('dashboard.owner'))
                    ->multiple()
                    ->relationship('owner', 'name')
                    ->searchable()
                    ->preload(),


                Tables\Filters\Filter::make('category')
                    ->label(__('dashboard.category'))
                    ->query(function (Builder $query, array $data): Builder {
                        if (!empty($data['category'])) {
                            $query->whereHas('categories', function ($subQuery) use ($data) {
                                $subQuery->whereIn('categories.id', $data['category']);
                            });
                        }
                        return $query;
                    })
                    ->form([
                        Select::make('category')
                            ->relationship('categories', app()->getLocale() === 'ar' ? 'name_ar' : 'name_en')
                            ->label(__('dashboard.category'))
                            ->multiple()
                            ->searchable()
                            ->preload(),
                    ])
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
            'view' => Pages\ViewPost::route('/{record}'),

        ];
    }
}
