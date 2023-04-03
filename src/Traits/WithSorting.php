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
        $this->sortDir = $this->sortBy === $field
            ? $this->reverseSort()
            : $this->defaultSortDir();

        $this->sortBy = $field;
    }

    public function initialSortBy(): string
    {
        return config('wire-table.sorting.by');
    }

    public function initialSortDir(): string
    {
        return config('wire-table.sorting.dir.initial');
    }

    public function defaultSortDir(): string
    {
        return config('wire-table.sorting.dir.default');
    }

    public function reverseSort(): string
    {
        return $this->sortDir === 'asc'
            ? 'desc'
            : 'asc';
    }

    public function sort(Builder $query, string $sortBy, string $sortDir): Builder
    {
        return $query->orderBy($sortBy, $sortDir);
    }

    protected function applySorting(Builder $query): Builder
    {
        return $this->sort($query, $this->sortBy, $this->sortDir);
    }
}
