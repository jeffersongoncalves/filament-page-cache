## Filament Page Cache

Filament page to watch and control the laravel-page-cache full-page cache: status, hit ratio, flush everything, forget one URL, pause and resume.

@verbatim
<code-snippet name="Register in PanelProvider" lang="php">
use JeffersonGoncalves\Filament\PageCache\PageCachePlugin;

$panel->plugins([
    PageCachePlugin::make(),
]);
</code-snippet>
@endverbatim

### Architecture
- `PageCachePlugin` registers `Pages\ManagePageCache` (header widget `Widgets\PageCacheStats`, actions forget / pause / resume / flush)
- Everything goes through `JeffersonGoncalves\PageCache\PageCache` from laravel-page-cache 1.2+ (state kept in the application cache)
- Translations live under `filament-page-cache::page-cache.*`
