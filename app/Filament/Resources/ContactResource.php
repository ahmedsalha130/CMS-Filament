<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?int $navigationSort = 6;

    public static function getNavigationLabel(): string
    {
        return __('dashboard.contacts');
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'warning' : 'primary';
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['name' ,'subject' ,'message','email'];
    }


    protected function afterSave(): void
    {
        // Redirect to index page
        $this->redirect($this->getResource()::getUrl('index'));
    }


    public static function getModelLabel(): string
    {
        return __('dashboard.contact');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.contacts');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('dashboard.name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label(__('dashboard.email'))
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label(__('dashboard.phone'))
                    ->tel()
                    ->required()
                    ->maxLength(20),
                TextInput::make('subject')
                    ->label(__('dashboard.subject'))
                    ->required()
                    ->maxLength(255),
                Textarea::make('message')
                    ->label(__('dashboard.message'))
                    ->required()
                    ->maxLength(1000),
                Checkbox::make('is_read')
                    ->label(__('dashboard.is_read')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')->label(__('dashboard.name')),
                Tables\Columns\TextColumn::make('email')->label(__('dashboard.email')),
                Tables\Columns\TextColumn::make('phone')->label(__('dashboard.phone')),
                Tables\Columns\TextColumn::make('subject')->label(__('dashboard.subject')),
                Tables\Columns\BooleanColumn::make('is_read')->label(__('dashboard.is_read')),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label(__('dashboard.created_at')),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_read')
                    ->label(__('Is Read'))
                    ->query(fn(Builder $query): Builder => $query->where('is_read', true)),
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
            'index' => Pages\ListContacts::route('/'),
//            'create' => Pages\CreateContact::route('/create'),
//            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
