<label class="d-flex align-items-center small text-muted mb-0">
  <span class="me-2">{{ __('wire-table::table.page_size') }}</span>
  <select class="form-select form-select-sm w-auto" wire:change="setPageSize($event.target.value)">
    @foreach($this->pageSizeOptions() as $option)
      <option value="{{ $option }}" @selected($option === $this->pageSize())>{{ $option }}</option>
    @endforeach
  </select>
</label>
