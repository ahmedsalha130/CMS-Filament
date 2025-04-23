<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use App\Models\Tag;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('createTagModal')
                ->label('Create Tag')
                ->icon('heroicon-m-plus')
                ->modalHeading('Create New Tag')
                ->modalSubmitActionLabel('Save')
                ->form([
                  TextInput::make('name')
                        ->label('Tag Name')
                        ->required()
                        ->unique(Tag::class, 'name'),
                Toggle::make('status')
                        ->label('Active')
                        ->default(true),
                ])
                ->action(function (array $data): void {
                    Tag::create($data);

                    Notification::make()
                        ->title('Tag created successfully')
                        ->success()
                        ->send();
                }),
        ];
    }
}
