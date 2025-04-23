<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {

        $this->migrator->add('theme.theme', 'string');
        $this->migrator->add('theme.primary_color', 'string');
        $this->migrator->add('theme.dark_mode', 'boolean');
    }
};
