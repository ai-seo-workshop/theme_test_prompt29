@if($paginator->lastPage() > 1)
<nav class="pagination" aria-label="Pagination"
     data-page="{{ $paginator->currentPage() }}"
     data-last-page="{{ $paginator->lastPage() }}">
  <ul class="pagination__list">

    {{-- Previous --}}
    @if($paginator->currentPage() > 1)
    <li class="pagination__item pagination__item--prev">
      <a href="?page={{ $paginator->currentPage() - 1 }}"
         class="pagination__link pagination__prev"
         data-page="{{ $paginator->currentPage() - 1 }}"
         aria-label="Previous page">
        &lsaquo; Prev
      </a>
    </li>
    @endif

    {{-- Page numbers --}}
    @php
      $start = max(1, $paginator->currentPage() - 2);
      $end   = min($paginator->lastPage(), $paginator->currentPage() + 2);
    @endphp

    @if($start > 1)
    <li class="pagination__item">
      <a href="?page=1" class="pagination__link" data-page="1" aria-label="Page 1">1</a>
    </li>
    @if($start > 2)
    <li class="pagination__item pagination__item--dots">
      <span class="pagination__dots">&hellip;</span>
    </li>
    @endif
    @endif

    @for($p = $start; $p <= $end; $p++)
    <li class="pagination__item">
      <a href="?page={{ $p }}"
         class="pagination__link pagination__page{{ $p === $paginator->currentPage() ? ' pagination__page--active' : '' }}"
         data-page="{{ $p }}"
         aria-label="Page {{ $p }}"
         @if($p === $paginator->currentPage()) aria-current="page" @endif>
        {{ $p }}
      </a>
    </li>
    @endfor

    @if($end < $paginator->lastPage())
    @if($end < $paginator->lastPage() - 1)
    <li class="pagination__item pagination__item--dots">
      <span class="pagination__dots">&hellip;</span>
    </li>
    @endif
    <li class="pagination__item">
      <a href="?page={{ $paginator->lastPage() }}"
         class="pagination__link"
         data-page="{{ $paginator->lastPage() }}"
         aria-label="Page {{ $paginator->lastPage() }}">
        {{ $paginator->lastPage() }}
      </a>
    </li>
    @endif

    {{-- Next --}}
    @if($paginator->currentPage() < $paginator->lastPage())
    <li class="pagination__item pagination__item--next">
      <a href="?page={{ $paginator->currentPage() + 1 }}"
         class="pagination__link pagination__next"
         data-page="{{ $paginator->currentPage() + 1 }}"
         aria-label="Next page">
        Next &rsaquo;
      </a>
    </li>
    @endif

  </ul>
</nav>
@endif
