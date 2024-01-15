<?php

namespace WireTable\Traits;

use Illuminate\Contracts\Database\Query\Builder;

/**
 * Trait with custom functionality for manual sorting on the supported columns
 */
trait WithSorting
{
    /**
     * Current field to sort by
     */
    public string $currentSortBy = '';

    /**
     * Current sorting direction (either 'desc' or 'asc')
     */
    public string $currentSortDir = '';

    public function mountWithSorting(): void
    {
        $this->currentSortDir = $this->initialSortDir();
        $this->currentSortBy = $this->initialSortBy();
    }

    public function sortBy(string $field): void
    {
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }

        $this->currentSortDir = $this->currentSortBy === $field
            ? $this->reverseSort()
            : $this->defaultSortDir();

        $this->currentSortBy = $field;
    }

    public function initialSortBy(): string
    {
        return property_exists($this, 'initialSortBy')
            ? $this->initialSortBy
            : config('wire-table.sorting.by');
    }

    public function initialSortDir(): string
    {
        return property_exists($this, 'initialSortDir')
            ? $this->initialSortDir
            : config('wire-table.sorting.dir.initial');
    }

    public function defaultSortDir(): string
    {
        return property_exists($this, 'defaultSortDir')
            ? $this->defaultSortDir
            : config('wire-table.sorting.dir.default');
    }

    public function reverseSort(): string
    {
        return $this->currentSortDir === 'asc'
            ? 'desc'
            : 'asc';
    }

    public function sort(Builder $query, string $sortBy, string $sortDir): Builder
    {
        return $query->reorder()->orderBy($sortBy, $sortDir);
    }

    protected function applySorting(Builder $query): Builder
    {
        return $this->sort($query, $this->currentSortBy, $this->currentSortDir);
    }
}
