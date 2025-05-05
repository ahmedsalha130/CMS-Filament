<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

use Filament\Widgets\StatsOverviewWidget\Stat;

class PostsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Posts', Post::count())
                ->description('All blog posts')
                ->chart([7, 2, 10, 3, 15, 4, 20])
                ->color('primary'),
        ];
    }
}
