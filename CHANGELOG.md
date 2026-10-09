# Changelog

All notable changes to this project will be documented in this file.

## 3.1.0 - 2026-10-08

New `navigationGroup()` option: put the Page cache page in one of your panel's own navigation groups (a string or a closure, so it can be translated), instead of the translated Settings group.

```php
PageCachePlugin::make()->navigationGroup(fn (): string => __('admin.navigation.settings'))

```
## 3.0.0 - 2026-10-08

First release for Filament 5.x.

## [Unreleased]
