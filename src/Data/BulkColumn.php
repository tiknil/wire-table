<?php

namespace WireTable\Data;

use Illuminate\View\View;

class BulkColumn extends Column
{
    public function __construct(private string $theme, private string $bulkKeyField, private bool $live = false)
    {
        return parent::__construct(
            label: '',
            key: '',
            sort: false,
            cellView: '',
            thStyle: ElementStyle::create(style: 'max-width: 50px'),
            tdStyle: null,
            dateFormat: null,
            map: null,
            isRaw: false,
        );
    }

    /**
     * Renders the cell content based on the column definition
     */
    public function render(mixed $item): string|View
    {
        return view("wire-table::{$this->theme}.bulk-select")
            ->with([
                'item' => $item,
                'key' => $item->{$this->bulkKeyField},
                'live' => $this->live,
            ]);
    }
}
