<div class="filament-hidden">

![Filament Page Cache](https://raw.githubusercontent.com/jeffersongoncalves/filament-page-cache/3.x/art/jeffersongoncalves-filament-page-cache.png)

</div>

# Filament Page Cache

[![Buy Me A Coffee](https://img.shields.io/badge/Buy%20Me%20A%20Coffee-support-FFDD00?style=flat-square&logo=buy-me-a-coffee&logoColor=black)](https://buymeacoffee.com/jeffersongoncalves)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-page-cache.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-page-cache)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-page-cache/fix-php-code-style-issues.yml?branch=3.x&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/filament-page-cache/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3A3.x)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/filament-page-cache.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-page-cache)
[![License](https://img.shields.io/packagist/l/jeffersongoncalves/filament-page-cache.svg?style=flat-square)](LICENSE.md)

A Filament page to watch and control the full-page cache of [jeffersongoncalves/laravel-page-cache](https://github.com/jeffersongoncalves/laravel-page-cache) — no terminal, no deploy:

- **Status, hit ratio, lifetime and last flush** at a glance (live, the stats poll)
- **Flush everything** after a content change
- **Forget one URL**: every cached variant of a path (locales, themes, query strings) is rebuilt on its next visit
- **Pause / resume** the cache while you debug a page

## Compatibility

| Branch | Filament | Package version |
|--------|----------|-----------------|
| 1.x | 3.x | `^1.0` |
| 2.x | 4.x | `^2.0` |
| 3.x | 5.x | `^3.0` |

## Installation

```bash
composer require jeffersongoncalves/filament-page-cache:"^3.0"
```

Set up [laravel-page-cache](https://github.com/jeffersongoncalves/laravel-page-cache#usage) first (the `CachePublicPage` middleware on your public routes). Hits and misses are counted while `page-cache.stats` is on (default).

## Usage

```php
use JeffersonGoncalves\Filament\PageCache\PageCachePlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            PageCachePlugin::make(),
        ]);
}
```

The plugin adds a **Page cache** page to the panel's Settings group. Register it only on panels whose users may flush the cache.

## Requirements

- PHP 8.2 or higher
- Filament 5.x
- [jeffersongoncalves/laravel-page-cache](https://github.com/jeffersongoncalves/laravel-page-cache) 1.2+

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
