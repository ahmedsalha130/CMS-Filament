<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {

        $this->migrator->add('footer.copyright', 'copyright');
        $this->migrator->add('footer.links', []);
        $this->migrator->add('footer.label', 'label');
        $this->migrator->add('footer.url', 'url');
    }
};
