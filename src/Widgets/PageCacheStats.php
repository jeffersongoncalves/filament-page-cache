<?php

namespace JeffersonGoncalves\Filament\PageCache\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use JeffersonGoncalves\PageCache\PageCache;

class PageCacheStats extends StatsOverviewWidget
{
    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        $stats = PageCache::stats();
        $status = ! $stats['enabled'] ? 'disabled' : ($stats['paused'] ? 'paused' : 'active');

        return [
            Stat::make(__('filament-page-cache::page-cache.status'), __("filament-page-cache::page-cache.{$status}"))
                ->description(__('filament-page-cache::page-cache.status_hint'))
                ->color(['active' => 'success', 'paused' => 'warning', 'disabled' => 'danger'][$status]),
            Stat::make(__('filament-page-cache::page-cache.hit_ratio'), $stats['hit_ratio'] === null ? '—' : round($stats['hit_ratio'] * 100, 1).'%')
                ->description(__('filament-page-cache::page-cache.hit_ratio_hint', ['hits' => number_format($stats['hits']), 'misses' => number_format($stats['misses'])])),
            Stat::make(__('filament-page-cache::page-cache.ttl'), $stats['ttl'] <= 0 ? __('filament-page-cache::page-cache.forever') : __('filament-page-cache::page-cache.seconds', ['seconds' => number_format($stats['ttl'])]))
                ->description(__('filament-page-cache::page-cache.ttl_hint')),
            Stat::make(__('filament-page-cache::page-cache.flushed_at'), $stats['flushed_at'] === null ? __('filament-page-cache::page-cache.never') : Carbon::parse($stats['flushed_at'])->diffForHumans())
                ->description(__('filament-page-cache::page-cache.version_hint', ['version' => $stats['version']])),
        ];
    }
}
