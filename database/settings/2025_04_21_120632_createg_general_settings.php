<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {

        $this->migrator->add('general.site_name', ''); // Default empty string
        $this->migrator->add('general.site_email', ''); // Default empty string
        $this->migrator->add('general.phone', ''); // Default empty string
        $this->migrator->add('general.logo', null); // Nullable
        $this->migrator->add('general.favicon', null); // Nullable
        $this->migrator->add('general.address', null); // Nullable
        $this->migrator->add('general.description', null); // Nullable
        $this->migrator->add('general.label', []); // Default empty array
        $this->migrator->add('general.links', []); // Default empty array
    }
};
