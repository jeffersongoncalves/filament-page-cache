<?php

namespace JeffersonGoncalves\Filament\PageCache;

use JeffersonGoncalves\Filament\PageCache\Widgets\PageCacheStats;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PageCacheServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-page-cache')
            ->hasTranslations()
            ->hasViews();
    }

    public function packageBooted(): void
    {
        // The stats widget polls, so Livewire must be able to resolve it by name on update requests.
        Livewire::component('filament-page-cache-stats', PageCacheStats::class);
    }
}
