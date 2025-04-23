<?php

namespace App\Filament\Resources\OwnerResource\Pages;

use App\Filament\Resources\OwnerResource;
use App\Trait\RedirectIndex;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOwner extends CreateRecord
{
    use RedirectIndex;

    protected static string $resource = OwnerResource::class;


    protected function afterSave(): void
    {
        // Redirect to index page
        $this->redirect($this->getResource()::getUrl('index'));
    }

}
