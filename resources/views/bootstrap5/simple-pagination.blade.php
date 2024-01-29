<div>
  @if ($paginator->hasPages())
    <nav class="d-flex flex-row align-items-center justify-content-between">

      <div>
        <p class="small text-muted">
          {!! __('wire-table::table.simple_page_number', [ 'page' => "<span class='fw-semibold'>{$paginator->currentPage()}</span>"]) !!}
        </p>
      </div>

      <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <li class="page-item disabled" aria-disabled="true">
            <span class="page-link">&lsaquo;</span>
          </li>
        @else
          @if(method_exists($paginator,'getCursorName'))
            <li class="page-item">
              <button dusk="previousPage" type="button" class="page-link" wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')" wire:loading.attr="disabled" rel="prev">&lsaquo;</button>
            </li>
          @else
            <li class="page-item">
              <button type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev">&lsaquo;</button>
            </li>
          @endif
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          @if(method_exists($paginator,'getCursorName'))
            <li class="page-item">
              <button dusk="nextPage" type="button" class="page-link" wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')" wire:loading.attr="disabled" rel="next">&rsaquo;</button>
            </li>
          @else
            <li class="page-item">
              <button type="button" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="next">&rsaquo;</button>
            </li>
          @endif
        @else
          <li class="page-item disabled" aria-disabled="true">
            <span class="page-link">&rsaquo;</span>
          </li>
        @endif
      </ul>
    </nav>
  @endif
</div>
