<?php

namespace App\Filament\Pages;

use App\Settings\FooterSettings;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageFooter extends SettingsPage
{
    protected static ?string $navigationLabel = 'Footer';

    protected static string $settings = FooterSettings::class;
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 2;

    protected static ?string $title = null;

    public function getTitle(): string
    {
        return __('dashboard.footer_setting');
    }
    public static function getNavigationLabel(): string
    {
        return __('dashboard.footer_setting');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('copyright')
                    ->label('Copyright notice')
                    ->required(),
                Repeater::make('links')
                    ->schema([
                        TextInput::make('label')->required(),
                        TextInput::make('url')
                            ->url()
                            ->required(),
                    ]),
            ]);
    }
}
