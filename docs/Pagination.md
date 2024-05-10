[Full Documentation](./README.md)

## Pagination

Wiretable supports both full pagination and simple pagination, using
the [default livewire support for both](https://laravel-livewire.com/docs/2.x/pagination).

You can customize the default behaviour globally inside the configuration file:

```php
'pagination' => [
    'simple' => false, 

    'size' => 10, # Default page size

    'each-side' => 1, # Number of pages to display at the side of the active page
],
```

Or locally, inside your table class:

```php
public bool $simplePagination = true;

public int $pageSize = 20;
```

In case you need to reset the current page (e.g. when a filter changes), you can do so with the `resetPage()` method.


### Placement

By default, pagination links and the record count are shown at the bottom, after the table. 
You can control where to show them by overriding these variables in your component:

```
protected bool $topPagination = false;

protected bool $bottomPagination = true;
```
