<?php

namespace WireTable\Views\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Table extends Component
{
    public function __construct(
        public string $class,
        private string $theme,
    ) {
        if (empty($this->class)) {
            $this->class = config('wire-table.class');
        }
    }

    public function render(): View
    {
        return view("wire-table::{$this->theme}.table");
    }
}
