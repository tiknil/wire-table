<?php

namespace WireTable;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireTable\Data\Column;
use WireTable\Traits\WithPagination;
use WireTable\Traits\WithSorting;

abstract class WireTable extends Component
{
    use WithPagination, WithSorting;

    public string $tableClass = '';

    public string $layoutView = '';

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

    public function layout(): string|View
    {
        return view($this->layoutView);
    }

    public function render(): View
    {
        return $this->renderTable();
    }

    public function renderTable(): View
    {
        return view('wire-table::default')->with($this->layoutData());
    }

    protected function layoutData(): array
    {
        $query = $this->query();
        $query = $this->filter($query);

        if (method_exists($this, 'applySorting')) {
            $query = $this->applySorting($query);
        }

        $paginator = $this->paginator($query);

        return [
            'paginator' => $paginator,
            'theme' => $this->theme(),
            'iconTheme' => $this->iconTheme(),
        ];
    }

    protected function theme(): string
    {
        return $this->theme ?? config('wire-table.theme');
    }

    protected function iconTheme(): string
    {
        return $this->iconTheme ?? config('wire-table.icon-theme');
    }
}
