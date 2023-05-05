[Full Documentation](./README.md)

## Columns

Each wiretable component is required to extend the `columns()` method, providing the array of `Column`s to render.

Most `Column` parameters are optional, and we can leverage PHP 8.0 named arguments to only specify what we need:

```php
public function columns(): array
{
    return [
        Column::create(label: __('backend.created_at'), key: 'created_at', sort: true, dateFormat: 'd M y H:i' ),
        Column::create(
            label: __('backend.name'), 
            key: 'name', 
            map: fn ($user) => $user->first_name . ' ' . $user->last_name
        ),
        Column::create(
            label: '',
            cellView: 'backend.users.actions',
            thStyle: [ 'style' => 'width: 200px' ],
            tdStyle: [ 'class' => 'table-actions' ],
        ),
        ...
    ];
}
```

- `label`: *Required*. The header label
- `key`: Used as the model field for base rendering and sorting. It is not required if the column is not sortable and
  provides custom rendering
- `sort`: When true, the column will be sortable. *False* by default
- `cellView`: When provided, the blade view with that name will be rendered. Use `$item` inside that blade view to refer
  to that row model (e.g. `$item->id` for the user id).
- `thStyle`: Custom styling for the column th element. Expects a `ElementStyle` object or an array with `style`
  and `class` keys.
- `tdStyle`: Same as thStyle, but applied to each td element of that column.
- `dateFormat`: Override the `date-format` option in the config file
- `map`: A closure, mapping the row model to a custom render string. Useful for simple transformations that does not
  require a custom view
- `isRaw`: When true, the content will not be HTML-escaped. Not needed when `cellView` is provided

> If you implement [custom row rendering](./Row.md), the parameters controlling how the cell is rendered will not be
> considered
