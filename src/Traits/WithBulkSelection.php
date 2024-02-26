<?php

namespace WireTable\Traits;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\View\View;
use WireTable\Data\BulkColumn;
use WireTable\Data\Column;

trait WithBulkSelection
{
    public array $bulkSelected = [];

    public function bulkQuery(): Builder
    {
        return $this->query()->whereIn($this->keyField(), $this->bulkSelected);
    }

    public function bulkClear(): void
    {
        $this->bulkSelected = [];
    }

    public function bulkAdd(mixed $key): void
    {
        $this->bulkSelected[] = $key;
    }

    public function bulkRemove(mixed $key): void
    {
        $this->bulkSelected = array_values(array_filter($this->bulkSelected, fn ($el) => $el != $key));
    }

    public function bulkToggle(mixed $key): void
    {
        $this->isBulkSelected($key)
            ? $this->bulkRemove($key)
            : $this->bulkAdd($key);
    }

    public function isBulkSelected(mixed $key): bool
    {
        return in_array($key, $this->bulkSelected);
    }

    public function bulkColumn(bool $live = false): Column
    {
        return new BulkColumn($this->theme(), $this->keyField(), $live);
    }

    public function bulkCheckbox(mixed $item, bool $live = false): string|View
    {
        return $this->bulkColumn($live)->render($item);
    }
}
