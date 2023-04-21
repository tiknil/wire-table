## Features documentation

- [Columns](./Columns.md)
- [Row rendering](./Row.md)
- [Filters](./Filters.md)
- [Sorting](./Sorting.md)
- [Pagination](./Pagination.md)
- [Themes](./Theme.md)

Refer to the repo main [Readme](../README.md) for install and basic usage

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
