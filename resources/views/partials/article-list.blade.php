@foreach($blogs as $blog)
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

    <h2 class="title56">
      <a href="{{ $blog->url }}">{{ $blog->title }}</a>
    </h2>

    @if($blog->summary)
    <p class="post56__excerpt">{{ Str::limit($blog->summary, 120) }}</p>
    @endif

    <div class="meta56 meta56--bottom">
      @if($blog->author)
      <span class="meta56__author">{{ $blog->author }}</span>
      @endif
      @if($blog->published_at)
      <span class="meta56__date">{{ $blog->published_at->format('M j, Y') }}</span>
      @endif
    </div>

  </div>
</article>
@endforeach
