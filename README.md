# Livewire extension for building tables

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tiknil/wire-table.svg?style=flat-square)](https://packagist.org/packages/tiknil/wire-table)
[![Total Downloads](https://img.shields.io/packagist/dt/tiknil/wire-table.svg?style=flat-square)](https://packagist.org/packages/tiknil/wire-table)
![GitHub Actions](https://github.com/tiknil/wire-table/actions/workflows/main.yml/badge.svg)

The aim of this project is to provide a useful boilerplate with sane defaults for building backoffice tables,
while allowing easy customization.

## Installation

`wire-table` requires PHP >= 8.0 and Laravel >= 9.0

```bash
composer require livewire/livewire:^2.0 tiknil/wire-table
```

**Optional** you can publish wire-table files for further customization:

```bash
php artisan vendor:publish --tag=wiretable:config # Config file
php artisan vendor:publish --tag=wiretable:views  # Blade views
php artisan vendor:publish --tag=wiretable:lang   # Lang translation files
```

## Usage

Create a new component using the `make:wiretable` command:

```bash
php artisan make:wiretable UsersTable
```

The UsersTable class will be created inside your `app/Livewire` folder.

A basic table:

```php
class UsersTable extends WireTable
{
    public function query(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::create(
                label: __('backend.created_at'),
                key: 'created_at',
                sort: true
            ),
            Column::create(
                label: __('backend.name'),
                key: 'name',
                sort: true
            ),
            Column::create(
                label: __('backend.email'),
                key: 'email',
                sort: true
            ),
        ];
    }
}
```

Include it in your blade file:

```
<livewire:users-table />
```

> Remember to include
> the [livewire javascript and css](https://laravel-livewire.com/docs/2.x/quickstart#install-livewire) in every page
> where
> you will be using it:

> The wire tables are just livewire components, so
> the [livewire documentation for rendering components](https://laravel-livewire.com/docs/2.x/rendering-components)
> applies here.

### Features

See the [Docs](./docs/README.md) for the full documentation.

- [Columns](./docs/Columns.md): data mapping, custom cell blade view or full row view customization.
- [Row rendering](./docs/Row.md): custom row rendering
- [Filters](./docs/Filters.md)
- [Sorting](./docs/Sorting.md)
- [Pagination](./docs/Pagination.md)
- [Theme and style](./docs/Theme.md)

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please
email [balduzzi.giorgio@tiknil.com](mailto:balduzzi.giorgio@tiknil.com) instead of using the issue
tracker.

## Credits

- [Giorgio Balduzzi](https://github.com/tiknil)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

----

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com), following the
[laravelpackage.com](https://laravelpackage.com) documentation.
