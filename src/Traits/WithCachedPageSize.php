<?php

namespace WireTable\Traits;

use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;

/**
 * Lets the user choose the page size, and remembers the choice (in cache) for
 * each user and for each page the table is displayed in.
 */
trait WithCachedPageSize
{
    public int $size = 10;

    public function mountWithCachedPageSize(): void
    {
        $options = $this->pageSizeOptions();

        // The default must be one of the selectable options
        $default = $this->defaultPageSize();
        if (!in_array($default, $options, true)) {
            $default = $options[0] ?? $default;
        }

        $cached = Cache::get($this->pageSizeCacheKey(), $default);

        $this->size = in_array($cached, $options, true) ? $cached : $default;
    }

    public function pageSize(): int
    {
        return $this->size;
    }

    public function setPageSize(int $newSize): void
    {
        if (!in_array($newSize, $this->pageSizeOptions(), true)) {
            return;
        }

        $this->size = $newSize;
        $this->resetPage();

        Cache::forever($this->pageSizeCacheKey(), $newSize);
    }

    public function showPageSizeSelector(): bool
    {
        return true;
    }

    protected function defaultPageSize(): int
    {
        return property_exists($this, 'pageSize')
            ? $this->pageSize
            : config('wire-table.pagination.size');
    }

    protected function pageSizeCacheKey(): string
    {
        // During livewire updates the request path is the update endpoint,
        // so we need the path of the page the component was originally rendered in
        $path = Livewire::originalPath() ?: request()->path();
        $owner = auth()->id() ?? 'guest-'.session()->getId();

        return 'wire-table.page-size.'.$owner.'.'.sha1($path.'|'.static::class);
    }
}
