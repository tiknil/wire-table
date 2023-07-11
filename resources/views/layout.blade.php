@if(!empty($this->layoutView))

  @component($this->layoutView)
    @include('wire-table::component')
  @endcomponent

@else

  @include('wire-table::component')

@endif

