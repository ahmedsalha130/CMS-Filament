<?php

namespace App\Trait;

trait RedirectIndex
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
