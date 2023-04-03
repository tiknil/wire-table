<?php

namespace WireTable\Traits;

/**
 * Whenever a component property is updated through a model binding (e.g. wire:model="search"),
 * the table resets back to the first page. Useful when the only component properties are used for filtering
 */
trait ResetPageOnUpdate
{
    public function updatingResetPageOnUpdate(): void
    {
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }
}
