@extends('layout')
@section('title', $seoInfo->seo_title ?? $categoryInfo->name)
@section('description', $seoInfo->seo_desc ?? '')
@section('canonical', url($categoryInfo->url))
@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "CollectionPage",
      "name": "{{ addslashes($categoryInfo->name) }}",
      "url": "{{ url($categoryInfo->url) }}"
    }
    @if(!empty($crumbs) && count($crumbs) > 1)
    ,{
      "@type": "BreadcrumbList",
      "itemListElement": [
        @foreach($crumbs as $i => $crumb)
        {
          "@type": "ListItem",
          "position": {{ $i + 1 }},
          "name": "{{ addslashes($crumb['title']) }}",
          "item": "{{ $crumb['absolute_url'] }}"
        }{{ !$loop->last ? ',' : '' }}
        @endforeach
      ]
    }
    @endif
  ]
}
</script>
@endsection

@section('content')
<div class="wi-main__inner category-page">

  {{-- Category Titlebar --}}
  <div class="archive56 archive56__titlebar">
    <div class="container">
      <div class="titlebar56">
        <span class="titlebar56__label">Browse Category</span>
        <h1 class="titlebar56__title">{{ $categoryInfo->name }}</h1>
      </div>
      @include('partials.breadcrumb', ['crumbs' => $crumbs])
    </div>
  </div>

  {{-- Article Grid --}}
  <div class="category-content">
    <div class="container container--main">
      <div class="blog56 blog56--grid blog56--grid--4cols" id="blog-grid">
        @include('partials.article-list', ['blogs' => $blogs])
      </div>

      {{-- Pagination --}}
      <div id="pagination">
        @include('partials.pagination', ['paginator' => $blogs])
      </div>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
(function () {
  'use strict';
  const blogGrid    = document.getElementById('blog-grid');
  const paginationEl = document.getElementById('pagination');
  if (!blogGrid || !paginationEl) return;

  paginationEl.addEventListener('click', function (e) {
    const link = e.target.closest('[data-page]');
    if (!link) return;
    e.preventDefault();
    const page = link.dataset.page;
    const url  = window.location.pathname + '?page=' + page;
    fetch(url, {
      headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(function (r) { return r.json(); })
    .then(function (data) {
      blogGrid.innerHTML = data.html;
      updatePagination(data.pagination);
      window.scrollTo({ top: blogGrid.getBoundingClientRect().top + window.scrollY - 90, behavior: 'smooth' });
    });
  });

  function updatePagination(info) {
    const links = paginationEl.querySelectorAll('[data-page]');
    links.forEach(function (l) {
      const p = parseInt(l.dataset.page, 10);
      l.classList.toggle('pagination__page--active', p === info.current_page);
    });
  }
}());
</script>
@endpush
