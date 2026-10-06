---
name: wire-table
description: Guida all'uso della libreria tiknil/wire-table per creare tabelle in Laravel con Livewire
---

Libreria Laravel che estende Livewire per creare tabelle con paginazione, ordinamento, filtri e selezione bulk.

## Installazione

```bash
composer require livewire/livewire:^3.0 tiknil/wire-table
```

Pubblicazione file (opzionale):

```bash
php artisan vendor:publish --tag=wiretable:config
php artisan vendor:publish --tag=wiretable:views
php artisan vendor:publish --tag=wiretable:lang
```

## Creare una tabella

```bash
php artisan make:wiretable UsersTable
```

Questo crea `app/Livewire/UsersTable.php`.

### Metodi obbligatori

- `query(): Builder` — restituisce la query base
- `columns(): array` — restituisce l'array di `Column`

### Metodi opzionali

- `filter(Builder $query): Builder` — applica filtri
- `renderRow($item): string|View` — rendering custom della riga
- `render(): View` — layout custom

## Column

Parametri del factory method `Column::create()`:

| Parametro    | Tipo                        | Descrizione                                                               |
| ------------ | --------------------------- | ------------------------------------------------------------------------- |
| `label`      | `string`                    | Intestazione colonna (obbligatorio)                                       |
| `key`        | `string`                    | Campo del modello per rendering e sorting                                 |
| `sort`       | `bool`                      | `true` se ordinabile                                                      |
| `cellView`   | `string`                    | Nome blade view per cella custom (riceve `$item`)                         |
| `map`        | `Closure`                   | `fn ($item, $value) => ...` per trasformare il valore prima del rendering |
| `thStyle`    | `array\|ElementStyle\|null` | `['style' => '...', 'classList' => '...']`                                |
| `tdStyle`    | `array\|ElementStyle\|null` | Idem per le celle                                                         |
| `dateFormat` | `string\|null`              | Override del formato Carbon                                               |
| `isRaw`      | `bool`                      | Se `true`, non esegue l'escape HTML                                       |

Salvo tabelle semplici, preferisci l'utilizzo di renderRow per creare layout più complessi.

### BulkColumn

Per la selezione bulk via checkbox, usa il trait `WithBulkSelection` e aggiungi `$this->bulkColumn()` nell'array delle colonne.

```php
use WireTable\Traits\WithBulkSelection;

class UsersTable extends WireTable
{
    use WithBulkSelection;

    public function columns(): array
    {
        return [
            $this->bulkColumn(),
            Column::create(label: 'Name', key: 'name'),
        ];
    }
}
```

## Filtri

Dichiara una proprietà pubblica Livewire e usa `wire:model` nel blade. Estendi `filter()` per applicare la logica.

```php
public string $search = '';

public function filter(Builder $query): Builder
{
    return $query->when($this->search, fn ($q) =>
        $q->where('name', 'like', "%{$this->search}%")
    );
}
```

### Reset pagina su filtro

Usa il trait `ResetPageOnUpdate` — resetta la pagina a ogni `updating`. Si tratta del comportamento atteso di una tabella: al cambio filtri si riparte dalla pagina iniziale.

### Persistenza filtri

Usa `WithPersistence` e dichiara `$persist` coi nomi delle proprietà da salvare in sessione.

```php
use WireTable\Traits\WithPersistence;

class UsersTable extends WireTable
{
    use WithPersistence;

    protected array $persist = ['search', 'role'];
}
```

Override della chiave sessione: `public string $sessionKey = "custom:key"`.

Pulisci con `$this->clearPersistence()`.

## Ordinamento

Il trait `WithSorting` è incluso in `WireTable` e gestisce l'ordinamento.

Configurabile globalmente (config/wire-table.php > `sorting`) o localmente:

```php
public string $initialSortBy = 'email';
public string $initialSortDir = 'desc';
public string $defaultSortDir = 'asc';
```

Per ordinamento custom:

```php
public function sort(Builder $query, string $sortBy, string $sortDir): Builder
{
    if ($sortBy === 'your_field') {
        return $query->orderBy('another_field', $sortDir);
    }
    return parent::sort($query, $sortBy, $sortDir);
}
```

## Paginazione

`WireTable` usa il trait `WithPagination` di Livewire con override.

| Proprietà           | Default | Descrizione                                        |
| ------------------- | ------- | -------------------------------------------------- |
| `$simplePagination` | `false` | Usa simplePaginate (evita query di totale records) |
| `$pageSize`         | `10`    | Elementi per pagina                                |
| `$topPagination`    | `false` | Mostra paginazione sopra                           |
| `$bottomPagination` | `true`  | Mostra paginazione sotto                           |

Config global: `config/wire-table.php > pagination`.

Accesso al paginator: `$this->paginatedData` (computed property, non chiamare come metodo).

## Tema

Temi supportati: `bs5` (default), `bs4`.

Temi icone: `bs-icons` (default), `fa5`, `fa6`.

Override locale:

```php
protected $theme = 'bs4';
protected $iconTheme = 'fa5';
public string $tableClass = 'table-bordered table-striped';
```

Config global: `config/wire-table.php > theme`, `class`, `icon-theme`.

### Tema custom

Pubblica le views, crea una cartella col nome del tema in `resources/views/vendor/wire-table/` con i blade: `empty-row`, `header`, `loading`, `pagination`, `simple-pagination`, `style`, `table`.

### Icone custom

Aggiungi la voce nell'array `icons` del config.

## Row custom

Implementa `renderRow()` per controllare l'intero `<tr>`:

```php
public function renderRow($item): string|View
{
    return view('backend.users.table-row', ['user' => $item]);
}
```

Nota: quando usi `renderRow`, i parametri `cellView`, `map`, `isRaw`, `tdStyle` di `Column` non vengono considerati.

## Layout custom

Override di `render()` per inserire filtri o altro html intorno alla tabella:

```php
public function render(): View
{
    return view('backend.users.table-layout');
}
```

Nel blade, inserisci la tabella con `{!! $this->renderTable() !!}`.

## Selezione bulk

Usa `WithBulkSelection`:

```php
use WireTable\Traits\WithBulkSelection;

class UsersTable extends WireTable
{
    use WithBulkSelection;

    public function columns(): array
    {
        return [
            $this->bulkColumn(live: false), // checkbox
            Column::create(label: 'Name', key: 'name'),
        ];
    }
}
```

Metodi disponibili:

- `$this->bulkSelected` — array delle chiavi selezionate
- `$this->bulkQuery()` — query filtrata sulle selezionate
- `$this->bulkClear()`, `bulkAdd($key)`, `bulkRemove($key)`, `bulkToggle($key)`, `isBulkSelected($key)`

## Stili colonna

`ElementStyle` per personalizzare th/td:

```php
Column::create(
    label: 'Azioni',
    thStyle: ElementStyle::create(classList: '', style: 'width: 200px'),
    tdStyle: ['classList' => 'table-actions', 'style' => 'text-align: center'],
)
```

## Eventi

- `wiretable:reload` — ascolta l'evento per ricaricare la tabella
