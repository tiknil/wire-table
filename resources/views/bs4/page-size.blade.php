<div class="d-flex justify-content-start align-items-center mb-2">
  <label class="small text-muted mr-2 mb-0" for="wt-page-size-{{ $this->getId() }}">{{ __('wire-table::table.page_size') }}</label>
  <select id="wt-page-size-{{ $this->getId() }}" class="custom-select custom-select-sm w-auto"
          wire:change="setPageSize($event.target.value)">
    @foreach($this->pageSizeOptions() as $option)
      <option value="{{ $option }}" @selected($option === $this->pageSize())>{{ $option }}</option>
    @endforeach
  </select>
</div>
