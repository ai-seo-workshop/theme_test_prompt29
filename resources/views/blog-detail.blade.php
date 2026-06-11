@extends('layout')
@section('title', $blog->title)
@section('description', $blog->summary ?? '')
@section('canonical', $blog->absoluteUrl())
@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Article",
      "headline": "{{ addslashes($blog->title) }}",
      "datePublished": "{{ $blog->published_at?->toIso8601String() }}",
      "author": {"@type": "Person", "name": "{{ addslashes($blog->author ?? '') }}"},
      "url": "{{ $blog->absoluteUrl() }}"
    },
    {
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
    @if($blog->faq)
    ,{
      "@type": "FAQPage",
      "mainEntity": [
        @foreach($blog->faq as $faqItem)
        {
          "@type": "Question",
          "name": "{{ addslashes($faqItem['question']) }}",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{ addslashes(strip_tags($faqItem['answer'])) }}"
          }
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
<div class="single-placement">
  <div class="container container--single">
    <article id="wi-content" class="single56 no-sidebar">

      {{-- Article Header --}}
      <header class="single56__header">
        @include('partials.breadcrumb', ['crumbs' => $crumbs])

        @if(isset($blog->category_name) && $blog->category_name)
        <div class="meta56">
          <span class="meta56__category--fancy">
            <a href="{{ $blog->category->url ?? '#' }}">{{ $blog->category_name }}</a>
          </span>
        </div>
        @endif

        <h1 class="single56__title">{!! $blog->h1 !!}</h1>

        <div class="single56__meta meta56">
          @if($blog->author)
          <span class="meta56__author">{{ \App\Models\MaterielTask::by(app()->getLocale()) }} <strong>{{ $blog->author }}</strong></span>
          @endif
          @if($blog->published_at)
          <span class="meta56__sep">&mdash;</span>
          <span class="meta56__date">{{ \App\Models\MaterielTask::detailPublished(app()->getLocale()) }} {{ $blog->published_at->format('F j, Y') }}</span>
          @endif
          @if(isset($blog->category_name) && $blog->category_name)
          <span class="meta56__sep">&mdash;</span>
          <span class="meta56__filed">{{ \App\Models\MaterielTask::filedUnder(app()->getLocale()) }}
            <a href="{{ $blog->category->url ?? '#' }}">{{ $blog->category_name }}</a>
          </span>
          @endif
        </div>
      </header>

      {{-- Article Body --}}
      <div class="single56__body">
        <div class="entry-content single56__content">
          {!! $blog->content !!}
        </div>

        {{-- FAQ Section --}}
        @if(!empty($blog->faq))
        <div class="single56__faq">
          <h2 class="single56__faq-title">Frequently Asked Questions</h2>
          @foreach($blog->faq as $faqItem)
          <div class="faq-item">
            <h3 class="faq-item__question">{{ $faqItem['question'] }}</p>
            <div class="faq-item__answer">{!! $faqItem['answer'] !!}</div>
          </div>
          @endforeach
        </div>
        @endif
      </div>

      {{-- Related Posts --}}
      @if(!empty($relatedBlogs) && count($relatedBlogs))
      <aside class="single56__related">
        <p class="single56__section-label">{{ \App\Models\MaterielTask::related_posts(app()->getLocale()) }}</p>
        <div class="row">
          @foreach($relatedBlogs as $related)
          <div class="col col-1-3">
            <article class="post56 post56--grid">
              @if($related->head_img)
              <div class="thumbnail56">
                <a href="{{ $related->url }}">
                  <img src="{{ $related->head_img }}" alt="{{ $related->head_img_alt ?: $related->title }}" loading="lazy" decoding="async">
                </a>
              </div>
              @endif
              <div class="post56__body">
                @if(isset($related->category_name) && $related->category_name)
                <div class="meta56">
                  <span class="meta56__category--fancy">
                    <a href="{{ $related->category->url ?? '#' }}">{{ $related->category_name }}</a>
                  </span>
                </div>
                @endif
                <p class="title56">
                  <a href="{{ $related->url }}">{{ $related->title }}</a>
                </p>
                @if($related->published_at)
                <div class="meta56 meta56--bottom">
                  <span class="meta56__date">{{ $related->published_at->format('M j, Y') }}</span>
                </div>
                @endif
              </div>
            </article>
          </div>
          @endforeach
        </div>
      </aside>
      @endif

      {{-- Latest from Blog (popular/bottom posts) --}}
      @if(!empty($popularBlogs) && count($popularBlogs))
      <section class="single56__bottom-posts">
        <p class="single56__section-label">{{ \App\Models\MaterielTask::popular_articles(app()->getLocale()) }}</p>
        <div class="row">
          @foreach($popularBlogs as $popular)
          <div class="col col-1-4">
            <article class="post56 post56--grid">
              @if($popular->head_img)
              <div class="thumbnail56">
                <a href="{{ $popular->url }}">
                  <img src="{{ $popular->head_img }}" alt="{{ $popular->head_img_alt ?: $popular->title }}" loading="lazy" decoding="async">
                </a>
              </div>
              @endif
              <div class="post56__body">
                @if(isset($popular->category_name) && $popular->category_name)
                <div class="meta56">
                  <span class="meta56__category--fancy">
                    <a href="{{ $popular->category->url ?? '#' }}">{{ $popular->category_name }}</a>
                  </span>
                </div>
                @endif
                <p class="title56">
                  <a href="{{ $popular->url }}">{{ $popular->title }}</a>
                </p>
                @if($popular->published_at)
                <div class="meta56 meta56--bottom">
                  <span class="meta56__date">{{ $popular->published_at->format('M j, Y') }}</span>
                </div>
                @endif
              </div>
            </article>
          </div>
          @endforeach
        </div>
      </section>
      @endif

    </article>
  </div>
</div>
@endsection
