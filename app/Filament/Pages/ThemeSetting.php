<?php

namespace App\Filament\Pages;

use App\Settings\ThemeSettings;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ThemeSetting extends SettingsPage
{

    protected static string $settings = ThemeSettings::class;
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 3;

    protected static ?string $title = null;

    public function getTitle(): string
    {
        return __('dashboard.theme_setting');
    }
    public static function getNavigationLabel(): string
    {
        return __('dashboard.theme_setting');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            TextInput::make('theme')
                    ->label(__('Theme'))
                    ->required()
                    ->placeholder('e.g., light or dark')
                    ->default(fn() => app(ThemeSettings::class)->theme),
                ColorPicker::make('primary_color')
                    ->label(__('Primary Color'))
                    ->required()
                    ->default(fn() => app(ThemeSettings::class)->primary_color),
               Toggle::make('dark_mode')
                    ->label(__('Enable Dark Mode'))
                    ->default(fn() => app(ThemeSettings::class)->dark_mode),
            ]);
    }
}
