@if(!empty($crumbs))
<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol class="breadcrumb__list">
    @foreach($crumbs as $crumb)
    <li class="breadcrumb__item{{ $loop->last ? ' breadcrumb__item--current' : '' }}">
      @if(!$loop->last)
        <a href="{{ $crumb['absolute_url'] }}" class="breadcrumb__link">{{ $crumb['title'] }}</a>
        <span class="breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
      @else
        <span class="breadcrumb__current">{{ $crumb['title'] }}</span>
      @endif
    </li>
    @endforeach
  </ol>
</nav>
@endif
