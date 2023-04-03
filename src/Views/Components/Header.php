<?php

namespace WireTable\Views\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use WireTable\Data\Column;

class Header extends Component
{
    /**
     * @param  Column[]  $columns
     */
    public function __construct(
        public array $columns,
        private string $theme,
        private string $iconTheme,
    ) {
    }

    public function render(): View
    {
        return view("wire-table::{$this->theme}.header")->with([
            'icons' => config("wire-table.icons.{$this->iconTheme}"),
        ]);
    }
}
