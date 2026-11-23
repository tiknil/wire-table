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

### Page size selector

Add the `WithPageSize` trait to show a "rows per page" selector below the table (under the page links, left aligned).
The chosen value is stored in cache, separately for each user and for each page
(URL path + table class) where the table is displayed.

```php
use WireTable\Traits\WithPageSize;

class UsersTable extends WireTable
{
    use WithPageSize;

    // optional, default: [10, 25, 50, 100]
    public array $pageSizeOptions = [10, 30, 70];
}
```

#### Cache

The cached value expires after 30 days of inactivity (the expiration is refreshed every time it's used),
so the cache doesn't grow forever. Customize or disable it globally in `pagination.size-cache`
or in the component:

```php
public bool $cachePageSize = false;     // disable the cache: the choice lasts only for the current component state
public int $pageSizeCacheDays = 7;      // days before an unused value expires
```

Options can also be set globally with `pagination.size-options` in the config file.
Guests are tracked by session id.

### Scroll on page change

By default, on page change the table scrolls to the component root (`.wt`).
You can customize the target with a CSS selector, or disable it entirely:

**Globally** (in `config/wire-table.php`):
```php
'pagination' => [
    'scroll-to' => '#main-content', // or false to disable
],
```

**Locally**, in your table class:
```php
protected string|false $scrollTo = '#main-content';
```

An optional pixel offset can be set to account for fixed headers:

**Globally**:
```php
'pagination' => [
    'scroll-to' => '#main-content',
    'scroll-offset' => '4rem',
],
```

**Locally**:
```php
protected string|false $scrollTo = '#main-content';
protected string $scrollOffset = '4rem';
```

When `scrollTo` is `false` no scrolling occurs.
When `scrollOffset` is empty, `scrollIntoView` is used without margin.

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
