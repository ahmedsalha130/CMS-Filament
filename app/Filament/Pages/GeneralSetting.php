<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class GeneralSetting extends SettingsPage
{
//    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettings::class;
    protected static ?string $title = null;

    public function getTitle(): string
    {
        return __('dashboard.general_setting');
    }

    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('dashboard.general_setting');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('site_name')
                    ->label(__('dashboard.site_name'))
                    ->required(),

                Forms\Components\TextInput::make('site_email')
                    ->label(__('dashboard.site_email'))
                    ->email()
                    ->required(),

                Forms\Components\TextInput::make('phone')
                    ->label(__('dashboard.phone'))
                    ->required(),

                Forms\Components\FileUpload::make('logo')
                    ->label(__('dashboard.logo'))
                    ->image(),

                Forms\Components\FileUpload::make('favicon')
                    ->label(__('dashboard.favicon'))
                    ->image(),

                Forms\Components\Textarea::make('address')
                    ->label(__('dashboard.address')),

                Forms\Components\Textarea::make('description')
                    ->label(__('dashboard.description')),

                Forms\Components\Repeater::make('links')
                    ->label(__('dashboard.links'))
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->label(__('dashboard.link_label'))
                            ->required(),

                        Forms\Components\TextInput::make('url')
                            ->label(__('dashboard.link_url'))
                            ->url()
                            ->required(),
                    ])
                    ->minItems(1),
            ]);
    }
}
