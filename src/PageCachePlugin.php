<?php

namespace JeffersonGoncalves\Filament\PageCache;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\Filament\PageCache\Pages\ManagePageCache;

class PageCachePlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-page-cache';
    }

    public function register(Panel $panel): void
    {
        $panel->pages([ManagePageCache::class]);
    }

    public function boot(Panel $panel): void {}

    public static function make(): static
    {
        return app(static::class);
    }
}
