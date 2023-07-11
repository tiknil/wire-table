<?php

namespace WireTable\Views\Components;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public function __construct(
        public Paginator $paginator,
        public string $theme,
        public string $iconTheme)
    {
    }

    public function render(): View
    {
        return view('wire-table::layout');
    }
}
