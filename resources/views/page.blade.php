@extends('layout')
@section('title', $pageInfo->seo_title ?? '')
@section('description', $pageInfo->seo_desc ?? '')
@section('canonical', url('/'))

@section('content')
<div class="single-placement page-placement">
  <div class="container container--single">

    @isset($crumbs)
      @include('partials.breadcrumb', ['crumbs' => $crumbs])
    @endisset

    <article class="single56 single56--page no-sidebar">

      <header class="single56__header">
        <h1 class="single56__title">{!! $pageInfo->h1 !!}</h1>
      </header>

      <div class="single56__body">
        <div class="entry-content single56__content">
          {!! $pageInfo->content !!}
        </div>
      </div>

    </article>

  </div>
</div>
@endsection
