<?php
    // Ensure storage directories are writable for Blade view compilation.
    foreach ([storage_path('framework/views'), storage_path('framework/cache'), storage_path('framework/sessions')] as $_dir) {
        if (is_dir($_dir) && !is_writable($_dir)) { @chmod($_dir, 0775); }
    }
    unset($_dir);
?>
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
    <link rel="stylesheet" href="<?php echo e($theme->css('wave.css')); ?>?v=1.1">
<?php if(!empty($alternate_tag)): ?>
<?php echo $alternate_tag; ?>

<?php endif; ?>
<?php if(!empty($gtag)): ?>
<?php echo $gtag; ?>

<?php endif; ?>

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
                "name": "<?php echo str_replace('"', '\"', $crumb['title']); ?>",
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
    <link rel="stylesheet" href="<?php echo e($theme->css('seed.css')); ?>?v=1.1">
</head>
<body>


<header class="mng-header">
    <div class="mng-nav-inner">
        <a href="<?php echo e(app()->getLocale() === config('app.default_language') ? '/' : '/' . app()->getLocale() . '/'); ?>"
           class="mng-logo"
           aria-label="<?php echo e(config('app.name')); ?>">
            <img src="<?php echo e($theme->image('logo.png')); ?>" alt="<?php echo e(config('app.name')); ?>">
        </a>

        <button class="mng-nav-toggle" id="mngNavToggle" aria-label="Toggle navigation">
            <span></span>
        </button>

        <nav class="mng-nav-menu" id="mngNavMenu" aria-label="Global Navigation">
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($category->url); ?>"
               class="mng-nav-link <?php echo e(request()->is(trim($category->slug, '/')) ? 'is-active' : ''); ?>"><?php echo $category->name; ?></a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__currentLoopData = \App\Models\MaterielTask::SUPPORTS(app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(in_array($key, [2, 4])): ?>
<?php if(app()->getLocale() === config('app.default_language')): ?>
            <a href="<?php echo e('/'.$value['uri'].'/'); ?>" class="mng-nav-link"><?php echo $value['name']; ?></a>
<?php else: ?>
            <a href="<?php echo e('/'.app()->getLocale().'/'.$value['uri'].'/'); ?>" class="mng-nav-link"><?php echo $value['name']; ?></a>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>
    </div>
</header>


<main class="mng-page">
    <?php echo $__env->yieldContent('content'); ?>
</main>


<button class="mng-back-top" id="mngBackTop" aria-label="Back to top">&#8593;</button>


<footer class="mng-footer">
    <div class="mng-footer-top">




        <p class="footer-note"><?php echo strip_tags($slogan->content ?? ''); ?></p>

        <nav class="mng-footer-nav" aria-label="Footer Navigation">
<?php $__currentLoopData = \App\Models\MaterielTask::SUPPORTS(app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(in_array($key, [2, 3, 4, 7])): ?>
<?php if(app()->getLocale() === config('app.default_language')): ?>
            <a href="<?php echo e('/'.$value['uri'].'/'); ?>"><?php echo e($value['name']); ?></a>
<?php else: ?>
            <a href="<?php echo e('/'.app()->getLocale().'/'.$value['uri'].'/'); ?>"><?php echo e($value['name']); ?></a>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>
    </div>
    <div class="mng-footer-bot">
        &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.domain')); ?>. All rights reserved.
    </div>
</footer>

<script src="<?php echo e($theme->js('bak_top.js')); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/mynewsgh/layout.blade.php ENDPATH**/ ?>