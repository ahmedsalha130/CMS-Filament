<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;
    public function getHeaderActions(): array
    {
        return [
            Actions\Action::make('edit_post')
                ->label(trans('dashboard.edit'))
                ->icon('heroicon-o-pencil')
                ->url($this->getResource()::getUrl('edit', ['record' => $this->record->getKey()]))
                ->color('primary'),

//            Actions\Action::make('view_post')
//                ->label(trans('dashboard.view_post'))
//                ->icon('heroicon-o-eye')
//                ->url($this->getResource()::getUrl('view', ['record' => $this->record->getKey()]))
//                ->color('warning'),

            Actions\Action::make('manage_comments')
                ->label(trans('dashboard.comments'))
                ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ->url(fn($record) => route('filament.admin.resources.comments.index', ['tableFilters[post_id][value]' => $record->id]))// Redirect to the comments list with a filter on this post
                ->color('success'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('General')
                    ->collapsible()
                    ->schema([
                        TextEntry::make(app()->getLocale() === 'ar' ? 'title_' . app()->getLocale() : "title_en")
                            ->label(app()->getLocale() === 'ar' ? trans('dashboard.title_ar') : trans('dashboard.title_en'))
                            ->extraAttributes(['class' => 'font-bold text-xl text-blue-900 mb-2']),

                        TextEntry::make(app()->getLocale() === 'ar' ? 'slug_' . app()->getLocale() : "slug_en")
                            ->label(app()->getLocale() === 'ar' ? trans('dashboard.slug_ar') : trans('dashboard.slug_en'))
                            ->extraAttributes(['class' => 'text-gray-700 italic mb-2']),

                        TextEntry::make('owner')
                            ->label(trans('dashboard.owner'))
                            ->extraAttributes(['class' => 'font-medium text-gray-800 mb-2'])
                            ->getStateUsing(fn($record) => $record->owner->name),

                        TextEntry::make('categories')
                            ->label(trans('dashboard.categories'))
                            ->extraAttributes(['class' => 'text-gray-600'])
                            ->getStateUsing(fn($record) => $record->categories->pluck('name_' . app()->getLocale())->map(fn($category) => '<span style="display: inline-block; background-color: #F3F4F6; color: #1F2937; padding: 5px 10px; border-radius: 5px; margin-right: 5px; font-size: 0.875rem;">' . $category . '</span>')->join(' '))
                            ->html(),

                        TextEntry::make('tags')
                            ->label(trans('dashboard.tags'))
                            ->extraAttributes(['class' => 'text-gray-600'])
                            ->getStateUsing(fn($record) => $record->tags->pluck('name_' . app()->getLocale())->map(fn($tag) => '<span style="display: inline-block; background-color: #E5E7EB; color: #374151; padding: 5px 10px; border-radius: 5px; margin-right: 5px; font-size: 0.875rem;">' . $tag . '</span>')->join(' '))
                            ->html(),

                        TextEntry::make('main_image')
                            ->label(trans('dashboard.main_image'))
                            ->getStateUsing(fn($record) => $record->getFirstMediaUrl('main_image')
                                ? '<img src="' . $record->getFirstMediaUrl('main_image') . '" alt="Main Image" style="max-width: 120px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3); margin-bottom: 10px;">'
                                : '<span style="color: #999;">No Image Available</span>')
                            ->html(),
                    ])
                    ->columns(2)
                    ->extraAttributes(['class' => 'bg-gray-50 p-6 rounded-lg shadow-lg']),
                Section::make('Section Two')
                    ->collapsible()
                    ->schema([
                        TextEntry::make(app()->getLocale() === 'ar' ? 'content_' . app()->getLocale() : "content_en")
                            ->label(app()->getLocale() === 'ar' ? trans('dashboard.content_ar') : trans('dashboard.content_en'))
                            ->columnSpanFull()
                            ->extraAttributes(['class' => 'text-justify text-gray-700 leading-relaxed mb-4'])
                            ->html(),

                        TextEntry::make('images')
                            ->label(trans('dashboard.images'))
                            ->getStateUsing(fn($record) => $record->getMedia('images')->map(function ($media) {
                                return '<img src="' . $media->getFullUrl() . '" alt="Gallery Image" style="max-width: 100px; margin-right: 5px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3); margin-bottom: 10px;">';
                            })->join(' '))
                            ->html(),
                    ])
                    ->columns(1)
                    ->extraAttributes(['class' => 'mt-6 bg-white p-6 rounded-lg shadow-lg']),
            ]);
    }
}
