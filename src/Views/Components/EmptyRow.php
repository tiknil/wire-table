<?php

namespace WireTable\Views\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyRow extends Component
{
    public function __construct(private string $theme)
    {
    }

    public function render(): View
    {
        return view("wire-table::{$this->theme}.empty-row");
    }
}
