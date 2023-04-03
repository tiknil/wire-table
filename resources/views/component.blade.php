<div class="wt">

  @once
    @include('wire-table::style')
  @endonce

  {{ $this->renderBefore() }}

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

  {{ $paginator->onEachSide(config('wire-table.pagination.each-side'))->links() }}

  {{  $this->renderAfter() }}
</div>
