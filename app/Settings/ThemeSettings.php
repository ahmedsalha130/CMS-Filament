<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ThemeSettings extends Settings
{
    public string $theme; // e.g., 'light' or 'dark'
    public string $primary_color;
    public bool $dark_mode;

    public static function group(): string
    {
        return 'theme';
    }
}
