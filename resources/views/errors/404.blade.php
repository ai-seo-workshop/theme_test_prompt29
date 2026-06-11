@extends('layout')
@section('title', \App\Models\MaterielTask::page_not_found(app()->getLocale()) . ' | ' . config('app.name'))
@section('description', \App\Models\MaterielTask::desc_1_404(app()->getLocale()))

@section('content')
<div class="wi-main__inner error-page">
  <div class="container">
    <div class="error404">

      <div class="error404__code">404</div>
      <h1 class="error404__title">{{ \App\Models\MaterielTask::page_not_found(app()->getLocale()) }}</h1>
      <p class="error404__desc">{{ \App\Models\MaterielTask::desc_1_404(app()->getLocale()) }}</p>
      <p class="error404__desc">{{ \App\Models\MaterielTask::desc_2_404(app()->getLocale()) }}</p>

      <div class="error404__actions">
        <a href="/" class="btn btn--primary">{{ \App\Models\MaterielTask::go_to_homepage(app()->getLocale()) }}</a>
      </div>

      @isset($categories)
      <div class="error404__categories">
        <h2 class="error404__cat-title">{{ \App\Models\MaterielTask::popular_destinations(app()->getLocale()) }}</h2>
        <ul class="error404__cat-list">
          @foreach($categories as $cat)
          <li><a href="{{ $cat->url }}" class="error404__cat-link">{{ $cat->name }}</a></li>
          @endforeach
        </ul>
      </div>
      @endisset

    </div>
  </div>
</div>
@endsection
