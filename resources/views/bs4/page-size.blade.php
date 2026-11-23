<label class="d-flex align-items-center small text-muted mb-0">
  <span class="mr-2">{{ __('wire-table::table.page_size') }}</span>
  <select class="custom-select custom-select-sm w-auto" wire:change="setPageSize($event.target.value)">
    @foreach($this->pageSizeOptions() as $option)
      <option value="{{ $option }}" @selected($option === $this->pageSize())>{{ $option }}</option>
    @endforeach
  </select>
</label>
