[Full Documentation](./README.md)

## Row

You can fully customize how the row is rendered by implementing the `renderRow` method:

```php
public function renderRow($item): string|View
{
    return view('backend.users.table-row')->with(['user' => $item]);
}
```

```html

<tr>
    <td>{{ $user->created_at->translatedFormat('d M Y') }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
</tr>
```

This is useful when you have many cells requiring a complex rendering but you don't want to create a single blade file
for each cell.

> When you use a custom row rendering file, most of the column definition parameters are not considered
> anymore: `cellView`, `map`, `isRaw`, `tdStyle`
