<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class FooterSettings extends Settings
{


    public string $copyright ="copyright";

    public array $links =[];

    public string $label= "label";

    public string $url='url';

    public static function group(): string
    {
        return 'footer';
    }
}
