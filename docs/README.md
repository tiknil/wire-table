## Features documentation

- [Columns](./Columns.md)
- [Row rendering](./Row.md)
- [Filters](./Filters.md)
- [Sorting](./Sorting.md)
- [Pagination](./Pagination.md)
- [Themes](./Theme.md)

Refer to the repo main [Readme](../README.md) for install and basic usage

## Installation

`wire-table` requires PHP >= 8.0 and Laravel >= 9.0

```bash
composer require livewire/livewire:^2.0 tiknil/wire-table
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

## Publish files

Some customization require you to publish the wire table files.

```bash
php artisan vendor:publish --tag=wiretable:config # Config file
php artisan vendor:publish --tag=wiretable:views  # Blade views
php artisan vendor:publish --tag=wiretable:lang   # Lang translation files
```

> When you publish view files, you probably only need to edit the view inside a specific theme folder. It's recommended
> to delete from your `resources/views/vendor` folder the files you don't need to edit, especially the
> core `component.blade.php` file.  
