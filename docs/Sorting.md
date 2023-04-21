[Full Documentation](./README.md)

## Sorting

By default, Wiretable will order the results by the `created_at` table in `desc` order. When a new column is selected
for ordering, that column will start with the `asc` direction.

You can customize all this values both globally, in the config file:

```php
'sorting' => [
    'dir' => [
        'initial' => 'desc',
        'default' => 'asc',
    ],
    'by' => 'created_at',
],
```

Or locally, inside your table class:

```php
public string $initialSortBy = 'email';

public string $initialSortDir = 'desc';

public string $defaultSortDir = 'asc';
```

### Set sorting key

You can programmatically set the ordering key using the `sortBy` method. Calling it with the current sorting key will
reverse the sorting order.

```php
$this->sortBy('new_field')
```

### Custom orderBy

Once a column is selected for ordering, its `key` will be used in the SQL query. In case you need a custom behaviour for
some specific keys you can extend the `sort` method:

```php
 public function sort(Builder $query, string $sortBy, string $sortDir): Builder
{
    if ($sortBy === 'your_field') {
        return $query->orderBy('another_field', $sortDir);
    }
    return parent::sort($query, $sortBy, $sortDir);
}
```
