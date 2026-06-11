<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Site')</title>
  <meta name="description" content="@yield('description', '')">
  <link rel="canonical" href="@yield('canonical', '/')">
  {!! $alternate_tag ?? '' !!}
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">

  {{-- Theme CSS --}}
  <link rel="stylesheet" href="{{ asset('css56/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css56/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css56/footer.css') }}">
  <link rel="stylesheet" href="{{ asset('css56/grid.css') }}">

  @stack('styles')
  @yield('schema')

  @if(!empty($gtag ?? null))
  <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gtag }}"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{{ $gtag }}');
  </script>
  @endif
</head>
<body class="the-fox">
<div id="wi-all" class="fox-outer-wrapper wi-all">

  {{-- ===== DESKTOP HEADER ===== --}}
  <div class="masthead header-desktop masthead--sticky">
    <div class="masthead__wrapper">

      {{-- Topbar --}}
      <div id="topbar56" class="topbar56">
        <div class="container">
          <div class="topbar56__inner">
            <span class="topbar56__date">{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</span>
          </div>
        </div>
      </div>

      {{-- Main Header: Logo --}}
      <div id="header56" class="main-header56">
        <div class="container">
          <div class="main-header56__inner">
            <a href="/" class="main-header56__logo" aria-label="{{ config('app.name') }}">
              <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="site-logo">
            </a>
          </div>
        </div>
      </div>

      {{-- Main Navigation --}}
      <div id="nav56" class="nav56">
        <div class="container">
          <nav class="mainnav" aria-label="Main navigation">
            <ul class="menu">
              <li class="menu__item"><a href="/" class="menu__link">Home</a></li>
              @isset($categories)
                @foreach($categories as $cat)
                <li class="menu__item">
                  <a href="{{ $cat->url }}" class="menu__link">{{ $cat->name }}</a>
                </li>
                @endforeach
              @endisset
            </ul>
          </nav>
        </div>
      </div>

    </div>
  </div>

  {{-- ===== MOBILE HEADER ===== --}}
  <div id="header-mobile" class="header-mobile">
    <div class="header-mobile__inner">
      <button class="hamburger" aria-expanded="false" aria-controls="mobile-nav-overlay" aria-label="Open navigation">
        <span class="hamburger__line"></span>
        <span class="hamburger__line"></span>
        <span class="hamburger__line"></span>
      </button>
      <a href="/" class="header-mobile__logo" aria-label="{{ config('app.name') }}">
        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="site-logo">
      </a>
    </div>
  </div>

  {{-- Mobile nav spacer --}}
  <div class="header-mobile__height"></div>

  {{-- ===== MOBILE NAV OVERLAY ===== --}}
  <div id="mobile-nav-overlay" class="mobile-nav-overlay" aria-hidden="true">
    <div class="mobile-nav-overlay__header">
      <button class="mobile-nav-overlay__close" aria-label="Close navigation">&#10005;</button>
    </div>
    <nav class="mobile-nav-overlay__nav" aria-label="Mobile navigation">
      <ul class="mobile-menu">
        <li class="mobile-menu__item"><a href="/" class="mobile-menu__link">Home</a></li>
        @isset($categories)
          @foreach($categories as $cat)
          <li class="mobile-menu__item">
            <a href="{{ $cat->url }}" class="mobile-menu__link">{{ $cat->name }}</a>
          </li>
          @endforeach
        @endisset
      </ul>
    </nav>
  </div>

  {{-- ===== PAGE CONTENT ===== --}}
  <div id="wi-main" class="wi-main">
    @yield('content')
  </div>

  {{-- ===== FOOTER ===== --}}
  <footer id="wi-footer" class="site-footer">
    <div class="site-footer__top">
      <div class="container">
        <div class="row">

          {{-- Column 1: Recent Posts --}}
          <div class="footer56__col col col-1-4">
            <div class="widget-area">
              <h3 class="widget-title">{{ \App\Models\MaterielTask::recent_posts(app()->getLocale()) }}</h3>
              <ul class="footer56__recent-posts">
                @isset($latestBlogs)
                  @foreach($latestBlogs->take(5) as $recentBlog)
                  <li class="footer56__recent-item">
                    <a href="{{ $recentBlog->url }}" class="footer56__recent-link">{{ $recentBlog->title }}</a>
                  </li>
                  @endforeach
                @endisset
              </ul>
            </div>
          </div>

          {{-- Column 2: Categories --}}
          <div class="footer56__col col col-1-4">
            <div class="widget-area">
              <h3 class="widget-title">Categories</h3>
              <ul class="footer56__cat-list">
                @isset($categories)
                  @foreach($categories as $cat)
                  <li><a href="{{ $cat->url }}" class="footer56__cat-link">{{ $cat->name }}</a></li>
                  @endforeach
                @endisset
              </ul>
            </div>
          </div>

          {{-- Column 3: Company (About + Contact) --}}
          <div class="footer56__col col col-1-4">
            <div class="widget-area">
              @php
                $supportsAll = \App\Models\MaterielTask::SUPPORTS(app()->getLocale());
                $companyLabel = \App\Models\MaterielTask::company(app()->getLocale());
              @endphp
              <h3 class="widget-title">{{ $companyLabel }}</h3>
              <ul class="footer56__link-list">
                @foreach($supportsAll as $type => $item)
                  @if(in_array($type, [2, 3]))
                  <li><a href="{{ url($item['uri']) }}" class="footer56__link">{{ $item['name'] }}</a></li>
                  @endif
                @endforeach
              </ul>
            </div>
          </div>

          {{-- Column 4: Legal (Privacy + Terms) --}}
          <div class="footer56__col col col-1-4">
            <div class="widget-area">
              @php
                $legalLabel = \App\Models\MaterielTask::legal(app()->getLocale());
              @endphp
              <h3 class="widget-title">{{ $legalLabel }}</h3>
              <ul class="footer56__link-list">
                @foreach($supportsAll as $type => $item)
                  @if(in_array($type, [4, 7]))
                  <li><a href="{{ url($item['uri']) }}" class="footer56__link">{{ $item['name'] }}</a></li>
                  @endif
                @endforeach
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>

    {{-- Copyright Bar --}}
    <div class="site-footer__bottom">
      <div class="container">
        <p class="site-footer__copyright">
          {!! \App\Models\MaterielTask::copyright(app()->getLocale()) !!}
        </p>
      </div>
    </div>
  </footer>

</div>{{-- #wi-all --}}

<script defer src="{{ asset('js56/main.js') }}"></script>
@stack('scripts')
</body>
</html>
