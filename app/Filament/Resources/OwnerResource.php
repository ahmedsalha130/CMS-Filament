<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OwnerResource\Pages;
use App\Filament\Resources\OwnerResource\RelationManagers;
use App\Models\Owner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OwnerResource extends Resource
{
    protected static ?string $model = Owner::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?int $navigationSort =4;

    public static function getNavigationLabel(): string
    {
        return __('dashboard.owner');
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['name' ,'email' ,'phone'];
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'warning' : 'primary';
    }





    public static function getModelLabel(): string
    {
        return __('dashboard.owner');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.owner');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(Owner::class, 'email', ignoreRecord: true)
                    ->required(),
                Forms\Components\FileUpload::make('photo')
                    ->directory('uploads/owners') // Use 'owners' as the module name
                    ->image() // Restrict to image files
                    ->visibility('public'), // Make the files publicly accessible
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->unique(Owner::class, 'phone', ignoreRecord: true)
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrateStateUsing(fn($state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn($state) => filled($state)),
                Forms\Components\Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('Phone')->searchable(),

                Tables\Columns\ImageColumn::make('photo')
                    ->label('Avatar')
                    ->circular(),
                Tables\Columns\TextColumn::make('phone')->label('Phone'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),

            ])
            ->filters([
                //
                Tables\Filters\Filter::make('is_active')
                    ->label('Active')
                    ->query(function (Builder $query) {
                        $query->where('is_active', true);
                    }),
                Tables\Filters\Filter::make('created_today')
                    ->label('Created Today')
                    ->query(function (Builder $query) {
                        $query->whereDate('created_at', now()->toDateString());
                    }),
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
            'index' => Pages\ListOwners::route('/'),
//            'create' => Pages\CreateOwner::route('/create'),
//            'edit' => Pages\EditOwner::route('/{record}/edit'),
        ];
    }
}
