'use strict';

// ============================================================
// Mobile navigation toggle
// ============================================================
(function () {
  const hamburger = document.querySelector('.hamburger');
  const mobileNav = document.getElementById('mobile-nav-overlay');
  const closeBtn  = document.querySelector('.mobile-nav-overlay__close');

  if (!hamburger || !mobileNav) return;

  function openNav() {
    mobileNav.classList.add('is-open');
    mobileNav.setAttribute('aria-hidden', 'false');
    hamburger.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
  }

  function closeNav() {
    mobileNav.classList.remove('is-open');
    mobileNav.setAttribute('aria-hidden', 'true');
    hamburger.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  }

  hamburger.addEventListener('click', function () {
    const isOpen = mobileNav.classList.contains('is-open');
    if (isOpen) {
      closeNav();
    } else {
      openNav();
    }
  });

  if (closeBtn) {
    closeBtn.addEventListener('click', closeNav);
  }

  // Close overlay on Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && mobileNav.classList.contains('is-open')) {
      closeNav();
    }
  });

  // Close overlay when clicking a nav link
  mobileNav.querySelectorAll('.mobile-menu__link').forEach(function (link) {
    link.addEventListener('click', closeNav);
  });
}());

// ============================================================
// Category page AJAX pagination
// ============================================================
(function () {
  const blogGrid     = document.getElementById('blog-grid');
  const paginationEl = document.getElementById('pagination');

  if (!blogGrid || !paginationEl) return;

  paginationEl.addEventListener('click', function (e) {
    const link = e.target.closest('[data-page]');
    if (!link) return;
    e.preventDefault();

    const page = link.dataset.page;
    const url  = window.location.pathname + '?page=' + page;

    link.classList.add('loading');

    fetch(url, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    })
    .then(function (r) {
      if (!r.ok) throw new Error('Network response was not ok');
      return r.json();
    })
    .then(function (data) {
      blogGrid.innerHTML = data.html;
      updatePagination(data.pagination);
      // Update browser URL without reload
      window.history.pushState({}, '', url);
      // Scroll to grid top
      var top = blogGrid.getBoundingClientRect().top + window.scrollY - 90;
      window.scrollTo({ top: top, behavior: 'smooth' });
    })
    .catch(function (err) {
      console.error('Pagination fetch error:', err);
    })
    .finally(function () {
      link.classList.remove('loading');
    });
  });

  function updatePagination(info) {
    if (!info) return;
    var links = paginationEl.querySelectorAll('[data-page]');
    links.forEach(function (l) {
      var p = parseInt(l.dataset.page, 10);
      l.classList.toggle('pagination__page--active', p === info.current_page);
    });
  }
}());

// ============================================================
// Sticky header scroll shadow
// ============================================================
(function () {
  var masthead = document.querySelector('.masthead--sticky');
  if (!masthead) return;

  var lastScroll = 0;
  window.addEventListener('scroll', function () {
    var y = window.scrollY;
    if (y > 10) {
      masthead.classList.add('is-scrolled');
    } else {
      masthead.classList.remove('is-scrolled');
    }
    lastScroll = y;
  }, { passive: true });
}());
