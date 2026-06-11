<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">

    <link rel="canonical" href="<?php echo e(url()->current()); ?>/">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=1.5">
    <link rel="stylesheet" href="/css/all.min.css?v=1.1">
    <link rel="stylesheet" href="<?php echo e($theme->css('shell.css')); ?>?v=1.1">
<?php if(!empty($alternate_tag)): ?><?php echo $alternate_tag; ?><?php endif; ?>
<?php if(!empty($gtag)): ?><?php echo $gtag; ?><?php endif; ?>

<?php if(isset($crumbs) && count($crumbs) > 0): ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            <?php $__currentLoopData = $crumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            {
                "@type": "ListItem",
                "position": <?php echo e($index + 1); ?>,
                "name": "<?php echo str_replace("\"", "\\\"", $crumb['title']); ?>",
                "item": "<?php echo e($crumb['absolute_url']); ?>"
            }<?php if(!$loop->last): ?>,<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ]
    }
    </script>
<?php endif; ?>

<?php if(isset($blog) && $blog && in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['blog', 'blog.show', 'blog.show.localized'])): ?>
    <script type="application/ld+json">
    [
        {
            "@context": "https://schema.org",
            "@type": "Article",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "<?php echo e(request()->url()); ?>/"
            },
            "headline": <?php echo json_encode(html_entity_decode($blog->title, ENT_QUOTES), JSON_UNESCAPED_UNICODE); ?>,
            "datePublished": "<?php echo e(date("Y-m-d\TH:i:sP", strtotime($blog->published_at))); ?>",
            "dateModified": "<?php echo e(date("Y-m-d\TH:i:sP", strtotime($blog->update_time))); ?>",
            "description": <?php echo json_encode(html_entity_decode($blog->summary, ENT_QUOTES), JSON_UNESCAPED_UNICODE); ?>,
            "image": {
                "@type": "ImageObject",
                "url": "<?php echo e(request()->root().$blog->head_img); ?>",
                "contentUrl": "<?php echo e(request()->root().$blog->head_img); ?>"
            }
        }
        <?php if(!empty($blog->faq)): ?>,
        {
            "@context": "https://schema.org",
            "@type": "FAQPage",
            "mainEntity": [
               <?php $__currentLoopData = $blog->faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    "@type": "Question",
                    "name": <?php echo json_encode(html_entity_decode($faq['question'], ENT_QUOTES), JSON_UNESCAPED_UNICODE); ?>,
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": <?php echo json_encode(html_entity_decode($faq['answer'], ENT_QUOTES), JSON_UNESCAPED_UNICODE); ?>

                    }
                }<?php if(!$loop->last): ?>,<?php endif; ?>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ]
        }
        <?php endif; ?>
    ]
    </script>
<?php endif; ?>
<?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>


<div class="dlt4-topbar">
    <div class="dlt4-topbar-inner">
        <div class="dlt4-topbar-left">
            <span><?php echo e(date('l, F j, Y')); ?></span>
            <span class="dlt4-topbar-sep">|</span>
<?php $__currentLoopData = \App\Models\MaterielTask::SUPPORTS(app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(in_array($key, [2, 3, 4, 7])): ?>
<?php if(app()->getLocale() === config('app.default_language')): ?>
            <a href="<?php echo e('/'.$value['uri'].'/'); ?>"><?php echo e($value['name']); ?></a>
<?php else: ?>
            <a href="<?php echo e('/'.app()->getLocale().'/'.$value['uri'].'/'); ?>"><?php echo e($value['name']); ?></a>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>


<header class="dlt4-header">
    <div class="dlt4-header-inner">
        <a href="<?php echo e(app()->getLocale() === config('app.default_language') ? '/' : '/'.app()->getLocale().'/'); ?>"
           class="dlt4-logo" aria-label="<?php echo e(config('app.name')); ?>">
            <img src="<?php echo e($theme->image('logo.png')); ?>" alt="<?php echo e(config('app.name')); ?>">
        </a>
        <button class="dlt4-nav-toggle" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <nav class="dlt4-nav" aria-label="Global Navigation">
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($category->url); ?>"
               class="dlt4-nav-link <?php echo e(request()->is(trim($category->slug, '/')) ? 'is-active' : ''); ?>"><?php echo $category->name; ?></a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>
    </div>
</header>


<?php if(isset($hotBlogs) && $hotBlogs->isNotEmpty()): ?>
<div class="dlt4-trending">
    <div class="dlt4-trending-inner">
        <div class="dlt4-trending-track">
            <?php $__currentLoopData = $hotBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($tb->url); ?>"><?php echo $tb->title; ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $hotBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($tb->url); ?>"><?php echo $tb->title; ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>


<main class="dlt4-page-wrapper">
    <?php echo $__env->yieldContent('content'); ?>
</main>


<button class="dlt4-back-to-top" id="dlt4-backToTop" aria-label="Back to top">↑</button>


<footer class="dlt4-footer">
    <div class="dlt4-footer-inner">
        <div class="dlt4-footer-logo-col">
            <a href="<?php echo e(app()->getLocale() === config('app.default_language') ? '/' : '/'.app()->getLocale().'/'); ?>" aria-label="<?php echo e(config('app.name')); ?>">
                <img src="<?php echo e($theme->image('logo.png')); ?>" alt="<?php echo e(config('app.name')); ?>">
            </a>
            <div class="dlt4-footer-logo-name"><?php echo e(config('app.name')); ?></div>
        </div>
        <div class="dlt4-footer-about">

            <p class="dlt4-footer-about-text"><?php echo strip_tags($slogan->content ?? ''); ?></p>
        </div>
    </div>
    <div class="dlt4-footer-bar">
        <span>&copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.domain')); ?>. All rights reserved.</span>
        <div class="dlt4-footer-bar-links">
<?php $__currentLoopData = \App\Models\MaterielTask::SUPPORTS(app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(in_array($key, [2, 3, 4, 7])): ?>
<?php if(app()->getLocale() === config('app.default_language')): ?>
            <a href="<?php echo e('/'.$value['uri'].'/'); ?>"><?php echo e($value['name']); ?></a>
<?php else: ?>
            <a href="<?php echo e('/'.app()->getLocale().'/'.$value['uri'].'/'); ?>"><?php echo e($value['name']); ?></a>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</footer>

<script src="<?php echo e($theme->js('nav.js')); ?>"></script>
<script src="<?php echo e($theme->js('bak_top.js')); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/deliddedtech4/layout.blade.php ENDPATH**/ ?>