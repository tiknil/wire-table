<?php

namespace WireTable\Traits;

use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;

/**
 * Lets the user choose the page size. By default the choice is remembered (in cache)
 * for each user and for each page the table is displayed in.
 *
 * Customization (property on the component, or config 'wire-table.pagination.size-cache'):
 *  - $cachePageSize (bool):      enable/disable the cache
 *  - $pageSizeCacheDays (int):   days before an unused value expires (refreshed on every use)
 */
trait WithPageSize
{
    public int $size = 10;

    public function mountWithPageSize(): void
    {
        $options = $this->pageSizeOptions();

        // The default must be one of the selectable options
        $default = $this->defaultPageSize();
        if (!in_array($default, $options, true)) {
            $default = $options[0] ?? $default;
        }

        $this->size = $default;

        if (!$this->pageSizeCacheEnabled()) {
            return;
        }

        $cached = Cache::get($this->pageSizeCacheKey());

        if (in_array($cached, $options, true)) {
            $this->size = $cached;
            $this->storePageSize($cached); // refresh the ttl
        }
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

        if ($this->pageSizeCacheEnabled()) {
            $this->storePageSize($newSize);
        }
    }

    public function pageSizeCacheEnabled(): bool
    {
        return property_exists($this, 'cachePageSize')
            ? $this->cachePageSize
            : config('wire-table.pagination.size-cache.enabled', true);
    }

    /**
     * Days after which an unused cached value expires
     */
    public function pageSizeCacheDays(): int
    {
        return property_exists($this, 'pageSizeCacheDays')
            ? $this->pageSizeCacheDays
            : config('wire-table.pagination.size-cache.days', 30);
    }

    protected function storePageSize(int $size): void
    {
        Cache::put($this->pageSizeCacheKey(), $size, now()->addDays($this->pageSizeCacheDays()));
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
