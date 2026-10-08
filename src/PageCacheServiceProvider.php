<?php

namespace JeffersonGoncalves\Filament\PageCache;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PageCacheServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-page-cache')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations();
    }
}
