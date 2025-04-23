<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public string $site_email;
    public string $phone;
    public ?string $logo;
    public ?string $favicon;
    public ?string $address;
    public ?string $description;
    public array $label ;
    public array $links =[];

    public static function group(): string
    {
        return 'general';
    }
}
