<?php

namespace WireTable;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use WireTable\Data\Column;
use WireTable\Traits\WithPagination;
use WireTable\Traits\WithSorting;

abstract class WireTable extends Component
{
    use WithPagination, WithSorting;

    protected string $tableClass = '';

    abstract public function query(): Builder;

    public function filter(Builder $query): Builder
    {
        return $query;
    }

    /**
     * @return Column[]
     */
    abstract public function columns(): array;

    public function renderRow($item): string|View
    {
        return view('wire-table::row', ['item' => $item]);
    }

    public function render(): View
    {
        return $this->renderTable();
    }

    public function renderTable(): View
    {
        return view('wire-table::layout')->with($this->layoutData());
    }

    #[On('wiretable:reload')]
    public function reload()
    {
    }

    #[Computed]
    public function paginatedData(): Paginator
    {
        $query = $this->query();
        $query = $this->filter($query);

        if (method_exists($this, 'applySorting')) {
            $query = $this->applySorting($query);
        }

        return $this->paginator($query);
    }

    protected function layoutData(): array
    {
        return [
            'paginator' => $this->paginatedData,
            'theme' => $this->theme(),
            'iconTheme' => $this->iconTheme(),
        ];
    }

    protected function theme(): string
    {
        $theme = $this->theme ?? config('wire-table.theme');

        return match ($theme) {
            'bootstrap5' => 'bs5',
            'boostrap4' => 'bs4',
            default => $theme
        };
    }

    protected function iconTheme(): string
    {
        return $this->iconTheme ?? config('wire-table.icon-theme');
    }

    protected function keyField(): string
    {
        return 'id';
    }
}
