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

### Paginator

You can access the paginator element (e.g. to retrieve the records total) with `$this->paginatedData`, e.g:

```php
$total = $this->paginatedData->total()
```

> [!IMPORTANT]  
> `paginatedData` is a livewire computed property. If you change any other property after retrieving the paginator,
> those changes will not affect the query.
>
> It's also important to access the paginator as a property (`$this->paginatedData`) and not as a
> method (`$this->paginatedData()`) to avoid query duplication.

### Placement

By default, pagination links and the record count are shown at the bottom, after the table.
You can control where to show them by overriding these variables in your component:

```
protected bool $topPagination = false;

protected bool $bottomPagination = true;
```
