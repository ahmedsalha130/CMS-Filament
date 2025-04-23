<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?int $navigationSort = 5;

    public static function getGloballySearchableAttributes(): array
    {
        return ['post.title_ar' ,'post.title_en' ,'content','user.name'];
    }
    public static function getNavigationLabel(): string
    {
        return __('dashboard.comments');
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'warning' : 'primary';
    }



    protected function afterSave(): void
    {
        // Redirect to index page
        $this->redirect($this->getResource()::getUrl('index'));
    }


    public static function getModelLabel(): string
    {
        return __('dashboard.comment');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.comments');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('post_id')
                    ->required()
                    ->label(__('dashboard.post'))
                    ->searchable()
                    ->preload()
                    ->options(fn() => \App\Models\Post::pluck('title_' . app()->getLocale(), 'id')->toArray()),

                Forms\Components\Select::make('user_id')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label(__('dashboard.user'))
                    ->options(fn() => \App\Models\User::User()->pluck('name', 'id')->toArray()),

Forms\Components\Textarea::make('content')
    ->required()
    ->label(__('dashboard.content')),

Forms\Components\Toggle::make('is_approved')
    ->label(__('dashboard.is_approved')),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('post.title_' . app()->getLocale())
                    ->label(__('dashboard.post'))
                    ->sortable()
                    ->searchable()
                    ->url(fn($record) => route('filament.admin.resources.posts.edit', ['record' => $record->post_id]))
                    ->color('primary'),

                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('dashboard.user'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('content')
                    ->label(__('dashboard.content'))
                    ->limit(50),

                Tables\Columns\IconColumn::make('is_approved')
                    ->label(__('dashboard.is_approved'))
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('dashboard.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_approved')
                    ->label(__('dashboard.is_approved'))
                    ->options([
                        '1' => __('dashboard.yes'),
                        '0' => __('dashboard.no'),
                    ]),

                Tables\Filters\SelectFilter::make('post_id')
                    ->label(__('dashboard.post'))
                    ->options(fn() => \App\Models\Post::pluck('title_' . app()->getLocale(), 'id')->toArray())
                    ->searchable(),
                Tables\Filters\Filter::make('created_at')
                    ->label(__('dashboard.created_at'))
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label(__('dashboard.from')),
                        Forms\Components\DatePicker::make('created_to')
                            ->label(__('dashboard.to')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['created_from'], fn($q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['created_to'], fn($q, $date) => $q->whereDate('created_at', '<=', $date));
                    }),
            ])

            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

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
            'index' => Pages\ListComments::route('/'),
//            'create' => Pages\CreateComment::route('/create'),
//            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
