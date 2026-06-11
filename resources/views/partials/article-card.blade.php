{{-- Horizontal list card: small thumbnail right, text left --}}
<article class="post56 post56--list">
  <div class="post56--list__body">

    @if(isset($blog->category_name) && $blog->category_name)
    <div class="meta56">
      <span class="meta56__category--fancy">
        <a href="{{ $blog->category->url ?? '#' }}">{{ $blog->category_name }}</a>
      </span>
    </div>
    @endif

    <h3 class="title56 title56--list">
      <a href="{{ $blog->url }}">{{ $blog->title }}</a>
    </h3>

    <div class="meta56 meta56--bottom">
      @if($blog->author)
      <span class="meta56__author">{{ $blog->author }}</span>
      @endif
      @if($blog->published_at)
      <span class="meta56__date">{{ $blog->published_at->format('M j, Y') }}</span>
      @endif
    </div>

  </div>

  @if($blog->head_img)
  <div class="thumbnail56 thumbnail56--list">
    <a href="{{ $blog->url }}">
      <img src="{{ $blog->head_img }}" alt="{{ $blog->head_img_alt ?: $blog->title }}" loading="lazy" decoding="async">
    </a>
  </div>
  @endif
</article>
