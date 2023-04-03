<thead class="table-light">
@foreach($columns as $column)
  <th @class(['sortable' => $column->sort, ...$column->thStyle?->classList ?? [] ])
      style="{{ $column->thStyle?->style }}"

  >
    <a @if($column->sort)
         wire:click="sortBy('{{  $column->key }}')"
       @endif
       title="{{ __('wire-table::table.sort_label') }}"
    >
      {{ $column->label }}

      @if($column->sort)
        @if($this->sortBy !== $column->key)
          <i class="{{ $icons['base'] }} {{ $icons['sorting']['inactive'] }} text-muted"></i>
        @elseif($this->sortDir === 'asc')
          <i class="{{ $icons['base'] }} {{ $icons['sorting']['asc'] }}"></i>
        @elseif($this->sortDir === 'desc')
          <i class="{{ $icons['base'] }} {{ $icons['sorting']['desc'] }}"></i>
        @endif
      @endif
    </a>
  </th>
@endforeach
</thead>


