@extends('layout')
@section('title', $seoInfo->seo_title ?? '')
@section('description', $seoInfo->seo_desc ?? '')
@section('canonical', url('/'))
@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "{{ config('app.name') }}",
  "url": "{{ url('/') }}"
}
</script>
@endsection

@section('content')
<div class="wi-main__inner home-page">

  {{-- H1 (SEO, visually subtle) --}}
  <div class="home-h1-wrap container">
    <h1 class="home-h1">{{ $seoInfo->h1 ?: \App\Models\MaterielTask::homeH1(app()->getLocale()) }}</h1>
  </div>

  {{-- Category Sections --}}
  @isset($blogs)
    @foreach($blogs as $categoryId => $categoryBlogs)
      @php
        $firstBlog = $categoryBlogs->first();
        $categoryName = $firstBlog->category_name ?? ($firstBlog->category->name ?? '');
        $categoryUrl  = $firstBlog->category->url ?? '#';
        $restBlogs    = $categoryBlogs->slice(1)->take(4);
      @endphp
      <div class="section56 builder56__section">
        <div class="container container--main">

          <div class="section56__header">
            <h2 class="section56__title">
              <a href="{{ $categoryUrl }}">{{ $categoryName }}</a>
            </h2>
          </div>

          <div class="widget56__row">
            <div class="row">

              {{-- Featured (big) post --}}
              <div class="col col-2-3">
                <article class="post56 post56--grid post56--featured">
                  @if($firstBlog->head_img)
                  <div class="thumbnail56 thumbnail56--featured">
                    <a href="{{ $firstBlog->url }}">
                      <img src="{{ $firstBlog->head_img }}"
                           alt="{{ $firstBlog->head_img_alt ?: $firstBlog->title }}"
                           loading="lazy">
                    </a>
                  </div>
                  @endif
                  <div class="post56__body">
                    <div class="meta56">
                      <span class="meta56__category--fancy">
                        <a href="{{ $categoryUrl }}">{{ $categoryName }}</a>
                      </span>
                    </div>
                    <h2 class="title56 title56--featured">
                      <a href="{{ $firstBlog->url }}">{{ $firstBlog->title }}</a>
                    </h2>
                    @if($firstBlog->summary)
                    <p class="post56__excerpt">{{ $firstBlog->summary }}</p>
                    @endif
                    <div class="meta56 meta56--bottom">
                      @if($firstBlog->author)
                      <span class="meta56__author">{{ $firstBlog->author }}</span>
                      @endif
                      @if($firstBlog->published_at)
                      <span class="meta56__date">{{ $firstBlog->published_at->format('M j, Y') }}</span>
                      @endif
                    </div>
                  </div>
                </article>
              </div>

              {{-- List of smaller posts --}}
              <div class="col col-1-3">
                <div class="post56__list">
                  @foreach($restBlogs as $blog)
                    @include('partials.article-card', ['blog' => $blog])
                  @endforeach
                </div>
              </div>

            </div>
          </div>

          <div class="section56__footer">
            <a href="{{ $categoryUrl }}" class="section56__more-link">More in {{ $categoryName }} &rarr;</a>
          </div>

        </div>
      </div>
    @endforeach
  @endisset

  {{-- Latest Posts Section --}}
  @isset($latestBlogs)
  <div class="section56 builder56__section section56--latest">
    <div class="container container--main">

      <div class="section56__header">
        <h2 class="section56__title">{{ \App\Models\MaterielTask::recent_posts(app()->getLocale()) }}</h2>
      </div>

      <div class="blog56 blog56--grid blog56--grid--4cols" id="latest-grid">
        @foreach($latestBlogs as $blog)
        <article class="post56 post56--grid">
          @if($blog->head_img)
          <div class="thumbnail56">
            <a href="{{ $blog->url }}">
              <img src="{{ $blog->head_img }}" alt="{{ $blog->head_img_alt ?: $blog->title }}" loading="lazy" decoding="async">
            </a>
          </div>
          @endif
          <div class="post56__body">
            @if(isset($blog->category_name) && $blog->category_name)
            <div class="meta56">
              <span class="meta56__category--fancy">
                <a href="{{ $blog->category->url ?? '#' }}">{{ $blog->category_name }}</a>
              </span>
            </div>
            @endif
            <h3 class="title56">
              <a href="{{ $blog->url }}">{{ $blog->title }}</a>
            </h3>
            @if($blog->summary)
            <p class="post56__excerpt post56__excerpt--short">{{ Str::limit($blog->summary, 100) }}</p>
            @endif
            <div class="meta56 meta56--bottom">
              @if($blog->published_at)
              <span class="meta56__date">{{ $blog->published_at->format('M j, Y') }}</span>
              @endif
            </div>
          </div>
        </article>
        @endforeach
      </div>

    </div>
  </div>
  @endisset

</div>
@endsection
