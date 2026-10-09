---
name: filament-page-cache-development
description: Work with the Filament Page Cache plugin — the panel page that shows the laravel-page-cache hit ratio and flushes, forgets URLs, pauses and resumes the cache.
---

# Filament Page Cache Development

- **Package**: `jeffersongoncalves/filament-page-cache` (branch `2.x`, Filament 4.x)
- **Namespace**: `JeffersonGoncalves\Filament\PageCache`
- **Dependency**: `jeffersongoncalves/laravel-page-cache:^1.2` (`PageCache::flush()`, `forget()`, `pause()`, `resume()`, `stats()`)

## Setup

```php
$panel->plugins([\JeffersonGoncalves\Filament\PageCache\PageCachePlugin::make()]);
```

## Troubleshooting

- **Hit ratio stays at "—"**: no cacheable guest request yet, or `page-cache.stats` is false.
- **Status "Disabled in config"**: `page-cache.enabled` (`PAGE_CACHE_ENABLED`) is false; pause/resume only works on top of an enabled cache.
