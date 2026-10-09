<?php

use Filament\Facades\Filament;
use Illuminate\Foundation\Auth\User;
use JeffersonGoncalves\Filament\PageCache\PageCachePlugin;
use JeffersonGoncalves\Filament\PageCache\Pages\ManagePageCache;
use JeffersonGoncalves\Filament\PageCache\Widgets\PageCacheStats;
use JeffersonGoncalves\PageCache\PageCache;
use Livewire\Livewire;

beforeEach(function () {
    Filament::setCurrentPanel(Filament::getPanel('test'));
    $this->actingAs((new User)->forceFill(['id' => 1, 'name' => 'Admin', 'email' => 'admin@example.com']));
    PageCache::resume();
});

it('registers the page on the panel', function () {
    expect(Filament::getPanel('test')->getPages())->toContain(ManagePageCache::class)
        ->and(PageCachePlugin::make()->getId())->toBe('filament-page-cache');
});

it('uses translated labels', function () {
    expect(ManagePageCache::getNavigationLabel())->toBe('Page cache');

    app()->setLocale('pt_BR');

    expect((new ManagePageCache)->getTitle())->toBe('Cache de páginas');
});

it('puts the page in the group given to the plugin', function () {
    expect(ManagePageCache::getNavigationGroup())->toBe('Settings');

    Filament::getPanel('test')->getPlugin('filament-page-cache')->navigationGroup(fn (): string => 'System');

    expect(ManagePageCache::getNavigationGroup())->toBe('System');
});

it('flushes every page', function () {
    $version = PageCache::version();

    Livewire::test(ManagePageCache::class)->callAction('flush')->assertNotified();

    expect(PageCache::version())->toBe($version + 1);
});

it('forgets one path', function () {
    Livewire::test(ManagePageCache::class)
        ->callAction('forget', data: ['path' => 'https://example.com/blog/hello?x=1'])
        ->assertHasNoActionErrors()
        ->assertNotified();

    expect(PageCache::pathVersion('/blog/hello'))->toBe(1);
});

it('requires a path to forget', function () {
    Livewire::test(ManagePageCache::class)
        ->callAction('forget', data: ['path' => ''])
        ->assertHasActionErrors(['path' => 'required']);
});

it('pauses and resumes the cache', function () {
    Livewire::test(ManagePageCache::class)->callAction('pause');
    expect(PageCache::isPaused())->toBeTrue();

    Livewire::test(ManagePageCache::class)->callAction('resume');
    expect(PageCache::isPaused())->toBeFalse();
});

it('shows the cache status and hit ratio', function () {
    PageCache::recordHit();
    PageCache::recordHit();
    PageCache::recordHit();
    PageCache::recordMiss();

    Livewire::test(PageCacheStats::class)
        ->assertSee('Active')
        ->assertSee('75%')
        ->assertSee('3 hits · 1 misses since the last flush');
});
