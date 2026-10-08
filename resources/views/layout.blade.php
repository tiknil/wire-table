<div class="wt">

  @once
    @include("wire-table::$theme.style")
    <script>
      window.wireTableScrollTo = function (event, selector, offset) {
        const target = event.currentTarget.closest(selector) || document.querySelector(selector);

        if (!target) {
          return;
        }

        target.style.setProperty('scroll-margin-top', offset);
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      };
    </script>
  @endonce

  @if($this->topPagination)
    {{ $paginator->onEachSide(config('wire-table.pagination.each-side'))->links($this->paginationView(), ['scrollTo' => $scrollTo, 'scrollOffset' => $scrollOffset]) }}
  @endif

  <div class="wt-wrapper">
    <div class="wt-loading-wrap" wire:loading.flex>
      <div class="wt-loading">
        <x-wiretable::loading :theme="$theme"/>
      </div>
    </div>

    <x-wiretable::table :theme="$theme" :class="$this->tableClass">

      <x-wiretable::header :columns="$this->columns()" :theme="$theme" :icon-theme="$iconTheme"/>

      <tbody>
      @foreach($paginator as $item)
        {{ $this->renderRow($item) }}
      @endforeach

      @if($paginator->isEmpty())
        <x-wiretable::empty-row :theme="$theme"/>
      @endif
      </tbody>
    </x-wiretable::table>
  </div>

  @if($this->bottomPagination)
    {{ $paginator->onEachSide(config('wire-table.pagination.each-side'))->links($this->paginationView(), ['scrollTo' => $scrollTo, 'scrollOffset' => $scrollOffset]) }}
  @endif

</div>
