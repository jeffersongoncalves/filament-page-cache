<?php

namespace JeffersonGoncalves\Filament\PageCache;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\Filament\PageCache\Pages\ManagePageCache;

class PageCachePlugin implements Plugin
{
    protected string|Closure|null $navigationGroup = null;

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

    /** Put the page in one of the panel's own groups (defaults to the translated "Settings"). */
    public function navigationGroup(string|Closure|null $group): static
    {
        $this->navigationGroup = $group;

        return $this;
    }

    public function getNavigationGroup(): ?string
    {
        $group = $this->navigationGroup instanceof Closure ? ($this->navigationGroup)() : $this->navigationGroup;

        return $group === null ? null : (string) $group;
    }

    /** The plugin registered on the current panel, if any. */
    public static function current(): ?static
    {
        $panel = filament()->getCurrentPanel();

        if ($panel === null || ! $panel->hasPlugin('filament-page-cache')) {
            return null;
        }

        /** @var static */
        return $panel->getPlugin('filament-page-cache');
    }
}
