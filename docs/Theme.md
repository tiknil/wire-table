[Full Documentation](./README.md)

## Themes

> Wiretable does not include any theme css files. It's up to you to import bootstrap into your page

WireTable supports bootstrap 4 and bootstrap 5 (the default) out of the box.

The same applies for icons, with support for bootstrap icons (bs-icons), fontawesome 5 and 6 (fa5, fa6)

You are also free to add some custom classes to the `<table>` html element (e.g. `table-bordered` or `table-striped`).

---

You can declare your theme globally inside the configuration file

```php 
'theme' => 'bootstrap4',

'class' => 'table-bordered table-striped'
... 
'icon-theme' => 'bs-icons',
```

or locally inside your WireTable component

```php
class UsersTable extends WireTable {
    protected $theme = 'bootstrap4';
    
    protected $iconTheme = 'fa5';

    public string $tableClass = 'table-bordered table-striped';
    
    ...
```

### Customize a default theme

If you need to edit an existing theme, you need to [publish](./README.md#publish-files) the views and then edit the
files inside the `resources/views/vendor/wire-table/[theme]` folder.

### Define a custom theme

You can create a custom theme by:

- [Publishing](./README.md#publish-files) the views
- Create a folder with your theme name inside `resources/views/vendor/wire-table`, e.g. bulma.
- Inside that folder, create the following blade files:
    - `empty-row.blade.php`: what to render when there are no items to display
    - `header`: the header `thead` element. You will receive the `$columns` array
    - `loading`: the loading spinner
    - `pagination`: the pagination element.
    - `simple-pagination`: the simple pagination element
    - `style`: define some custom css rules and variables
    - `table`: the actual table element. Use `{{ $slot }}` for rendering the content
- Update your theme with the new folder name

### Define a custom icon theme

Simply add your theme to the `icons` array in the config file.
