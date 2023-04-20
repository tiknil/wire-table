<style lang="css" wire:ignore>
  .wt .wt-wrapper {
    overflow-x: auto;
    position: relative;
  }

  .wt .wt-wrapper .wt-loading-wrap {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;

    background-color: var(--wt-overlay-color, rgba(255, 255, 255, 0.5));

    {{-- display: flex is set dynamically by livewire --}}
   align-items: center;
    justify-content: center;
  }

  .wt .wt-wrapper .wt-loading-wrap .wt-loading {
    padding: 2rem 4rem;
    border-radius: 0.5rem;
    background-color: var(--bs-white);
    border: 1px solid var(--bs-gray-300);
  }

  .wt .wt-wrapper table th.sortable {
    padding-right: 1rem;
  }

  .wt .wt-wrapper table th.sortable a {
    display: block;
    cursor: pointer;
  }

  .wt .wt-wrapper table th.sortable i {
    float: right;
  }
</style>
