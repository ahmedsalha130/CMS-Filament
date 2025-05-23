<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateComment extends CreateRecord
{
    protected static string $resource = CommentResource::class;
    protected function afterSave(): void
    {
        // Redirect to index page
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
