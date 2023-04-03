<?php

namespace WireTable;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\View\View;
use Livewire\Component;
use WireTable\Data\Column;
use WireTable\Traits\WithPagination;

abstract class WireTable extends Component
{
    use WithPagination;

    public string $tableClass = '';

    abstract public function query(): Builder;

    public function filter(Builder $query): Builder
    {
        return $query;
    }

    /**
     * @return Column[]
     */
    abstract public function columns(): array;

    public function renderBefore(): string|View
    {
        return '';
    }

    public function renderAfter(): string|View
    {
        return '';
    }

    public function renderRow($item): string|View
    {
        return view('wire-table::row', ['item' => $item]);
    }

    public function render(): View
    {
        $query = $this->query();
        $query = $this->filter($query);

        if (method_exists($this, 'applySorting')) {
            $query = $this->applySorting($query);
        }

        return view('wire-table::component')
            ->with([
                'paginator' => $this->paginator($query),
                'theme' => $this->theme(),
                'iconTheme' => $this->iconTheme(),
            ]);
    }

    protected function theme(): string
    {
        return isset($this->theme) ? $this->theme : config('wire-table.theme');
    }

    protected function iconTheme(): string
    {
        return isset($this->iconTheme) ? $this->iconTheme : config('wire-table.icon-theme');
    }
}
