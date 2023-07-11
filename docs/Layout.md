[Full Documentation](./README.md)

## Layout

You can customize the layout around the table  (e.g. for [filters](./Filters.md)) by overriding the `render` method

```php
public function render(): View
{
    return view('backend.users.table-layout'));
}
```

Inside the view, you can control where the table will be rendered by placing this snippet:

```blade
{!! $this->renderTable() !!}
```
