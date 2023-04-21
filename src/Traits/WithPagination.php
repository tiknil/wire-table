<?php

namespace WireTable\Traits;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\WithPagination as LivewirePagination;

/**
 * Override of livewire default pagination trait for WireTable customization
 */
trait WithPagination
{
    use LivewirePagination;

    public function paginator(Builder $query): Paginator
    {
        return $this->simplePagination()
            ? $query->simplePaginate($this->pageSize())
            : $query->paginate($this->pageSize());
    }

    public function simplePagination(): bool
    {
        return property_exists($this, 'simplePagination')
            ? $this->simplePagination
            : config('wire-table.pagination.simple');
    }

    /**
     * Number of rows in each page
     */
    public function pageSize(): int
    {
        return property_exists($this, 'pageSize')
            ? $this->pageSize
            : config('wire-table.pagination.size');
    }

    /**
     * View for displaying the pagination links
     */
    public function paginationView(): string
    {
        return "wire-table::{$this->theme()}.pagination";
    }

    public function paginationSimpleView(): string
    {
        return "wire-table::{$this->theme()}.simple-pagination";
    }
}
