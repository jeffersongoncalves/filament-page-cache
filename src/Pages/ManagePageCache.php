<?php

namespace JeffersonGoncalves\Filament\PageCache\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use JeffersonGoncalves\Filament\PageCache\PageCachePlugin;
use JeffersonGoncalves\Filament\PageCache\Widgets\PageCacheStats;
use JeffersonGoncalves\PageCache\PageCache;

class ManagePageCache extends Page
{
    protected string $view = 'filament-page-cache::pages.manage-page-cache';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bolt';

    public static function getNavigationLabel(): string
    {
        return __('filament-page-cache::page-cache.navigation_label');
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return PageCachePlugin::current()?->getNavigationGroup() ?? __('filament-page-cache::page-cache.navigation_group');
    }

    public function getTitle(): string
    {
        return __('filament-page-cache::page-cache.title');
    }

    protected function getHeaderWidgets(): array
    {
        return [PageCacheStats::class];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('forget')
                ->label(__('filament-page-cache::page-cache.forget'))
                ->icon('heroicon-o-link')
                ->schema([
                    TextInput::make('path')
                        ->label(__('filament-page-cache::page-cache.path'))
                        ->helperText(__('filament-page-cache::page-cache.path_helper'))
                        ->placeholder('/blog/my-post')
                        ->required()
                        ->maxLength(2048),
                ])
                ->action(function (array $data): void {
                    PageCache::forget($data['path']);
                    $this->sendSuccess(__('filament-page-cache::page-cache.forgotten', ['path' => PageCache::normalizePath($data['path'])]));
                }),
            Action::make('pause')
                ->label(__('filament-page-cache::page-cache.pause'))
                ->icon('heroicon-o-pause')
                ->color('warning')
                ->visible(fn (): bool => ! PageCache::isPaused())
                ->action(function (): void {
                    PageCache::pause();
                    $this->sendSuccess(__('filament-page-cache::page-cache.paused_notice'));
                }),
            Action::make('resume')
                ->label(__('filament-page-cache::page-cache.resume'))
                ->icon('heroicon-o-play')
                ->color('success')
                ->visible(fn (): bool => PageCache::isPaused())
                ->action(function (): void {
                    PageCache::resume();
                    $this->sendSuccess(__('filament-page-cache::page-cache.resumed_notice'));
                }),
            Action::make('flush')
                ->label(__('filament-page-cache::page-cache.flush'))
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading(__('filament-page-cache::page-cache.flush_heading'))
                ->modalDescription(__('filament-page-cache::page-cache.flush_description'))
                ->action(function (): void {
                    PageCache::flush();
                    $this->sendSuccess(__('filament-page-cache::page-cache.flushed'));
                }),
        ];
    }

    protected function sendSuccess(string $title): void
    {
        Notification::make()->success()->title($title)->send();
    }
}
