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
    public string $sortBy = '';

    /**
     * Current sorting direction (either 'desc' or 'asc')
     */
    public string $sortDir = '';

    public function mountWithSorting(): void
    {
        $this->sortDir = $this->initialSortDir();
        $this->sortBy = $this->initialSortBy();
    }

    public function sortBy(string $field): void
    {
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }

        $this->sortDir = $this->sortBy === $field
            ? $this->reverseSort()
            : $this->defaultSortDir();

        $this->sortBy = $field;
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
        return $this->sortDir === 'asc'
            ? 'desc'
            : 'asc';
    }

    public function sort(Builder $query, string $sortBy, string $sortDir): Builder
    {
        return $query->reorder()->orderBy($sortBy, $sortDir);
    }

    protected function applySorting(Builder $query): Builder
    {
        return $this->sort($query, $this->sortBy, $this->sortDir);
    }
}
