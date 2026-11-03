<style lang="css" wire:ignore>
  .wt {
    --wt-overlay-color: rgba(var(--bs-body-bg-rgb, 255, 255, 255), 0.7);
    --wt-loading-bg: var(--bs-body-bg, var(--bs-white, #fff));
    --wt-loading-border: var(--bs-border-color, var(--bs-gray-300, #dee2e6));
  }

  [data-bs-theme="dark"] .wt,
  .dark .wt {
    --wt-overlay-color: rgba(var(--bs-body-bg-rgb, 33, 37, 41), 0.7);
    --wt-loading-bg: var(--bs-body-bg, #212529);
    --wt-loading-border: var(--bs-border-color, #495057);
  }

  .wt .wt-wrapper {
    overflow-x: auto;
    position: relative;
  }

  .wt .wt-wrapper .wt-loading-wrap {
    z-index: 2;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;

    background-color: var(--wt-overlay-color);

    justify-content: center;
    align-items: flex-start;
    padding: 4rem;
  }

  .wt .wt-wrapper .wt-loading-wrap .wt-loading {
    padding: 2rem 4rem;
    border-radius: 0.5rem;
    background-color: var(--wt-loading-bg);
    border: 1px solid var(--wt-loading-border);
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
