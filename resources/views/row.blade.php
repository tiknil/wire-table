<tr>
  @foreach($this->columns() as $column)
    <td @if($column->tdStyle)
          @class($column->tdStyle->classList)
          style="{{ $column->tdStyle->style }}"
      @endif
    >
      @if($column->isRaw)
        {!! $column->render($item) !!}
      @else
        {{ $column->render($item) }}
      @endif
    </td>
  @endforeach
</tr>
