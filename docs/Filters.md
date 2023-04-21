[Full Documentation](./README.md)

## Filtering

You can extend the `filter` method to add some filtering to your query.

This example will add a basic search input to your table.

```php
public string $searched = "";

public function filter(Builder $query): Builder
{
    return $query->when(
        !empty($this->searched ?? ''),
        fn ($q) => $q->where('name', 'like', "{$this->searched}%")
            ->orWhere('email', 'like', "{$this->searched}%")
    );
}
```

> ⚠️ the `query()` method should always return the base query, and conditional filtering should be done inside the
> filter() method

You can render your filters using the `renderBefore` or `renderAfter` methods:

```php
public function renderBefore(): string|View
{
    return view('backend.users.table-filters');
}
```

```html
<input type="search" class="form-control"
       wire:model.debounce.300ms="searched"
       aria-label="Search"
       placeholder="Search by name or email"/>
```

### Reset page on filtering

When a filter changes, it's usually recommended to reset the page number and return to the first table page.

This can be done in two ways:

**The `ResetPageOnUpdate` trait**:

```php
use \WireTable\Traits\ResetPageOnUpdate;

class RandomTable extends WireTable {
    use ResetPageOnUpdate;
    ...
```

This trait automatically listens for any [`updating` hook](https://laravel-livewire.com/docs/2.x/lifecycle-hooks) and
reset the page. This works as long as the only component properties using `wire:model` are used for filtering. If you
have some binded properties that should not reset the page at every update, go for the second option.

**Call resetPage() directly**

Whenever you appy a different filter inside your table (e.g. when a property updates or when you submit a form), you can
call `$this->resetPage()` directly.

```php
public function updatingSearched() 
{
    $this->resetPage();
}
```
