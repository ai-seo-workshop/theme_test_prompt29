<?php $__env->startSection('title'); ?><?php echo $seoInfo->seo_title; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?><?php echo $seoInfo->seo_desc; ?><?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e($theme->css('drift.css')); ?>?v=1.1">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<?php echo $__env->make($theme->view('partials.breadcrumb'), [
    'items' => [
        ['url' => app()->getLocale() === config('app.default_language') ? '/' : '/'.app()->getLocale().'/', 'name' => trans_theme('home')],
        ['url' => null, 'name' => $categoryInfo->name]
    ]
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="mng-cat-header">
    <h1 class="mng-cat-page-h1"><?php echo $categoryInfo->name; ?></h1>
<?php if(!empty($seoInfo->content)): ?>
    <p class="mng-cat-page-desc"><?php echo strip_tags($seoInfo->content); ?></p>
<?php endif; ?>
</div>


<?php
    $topItems = $sidebarPopular->take(5);
    $featuredItem = $topItems->first();
    $sideItems = $topItems->skip(1);
    $listItems = $sidebarPopular->skip(4);
?>

<?php if($topItems->isNotEmpty()): ?>
<div class="mng-cat-top">
    <div class="mng-cat-top-left">
<?php $__currentLoopData = $sideItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mng-cat-top-small">
            <a href="<?php echo e($item->url); ?>">
                <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" class="mng-cat-top-small__img" loading="eager">
            </a>
            <div class="mng-cat-top-small__body">
                <a href="<?php echo e($item->category ? $item->category->url : '#'); ?>" class="mng-cat-tag"><?php echo $item->category_name; ?></a>
                <span class="mng-time"> / <?php echo e(date('Y-m-d', strtotime($item->published_at))); ?></span>
                <div class="mng-cat-top-small__title">
                    <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
                </div>
            </div>
        </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if($featuredItem): ?>
    <div class="mng-cat-top-feature">
        <a href="<?php echo e($featuredItem->url); ?>">
            <img src="<?php echo e($featuredItem->head_img); ?>" alt="<?php echo e($featuredItem->head_img_alt); ?>" class="mng-cat-top-feature__img" loading="eager">
        </a>
        <div class="mng-cat-top-feature__overlay">
            <a href="<?php echo e($featuredItem->category ? $featuredItem->category->url : '#'); ?>" class="mng-cat-badge"><?php echo e($featuredItem->category_name); ?></a>
            <span class="mng-time" style="color: #fff"> / <?php echo e(date('Y-m-d', strtotime($featuredItem->published_at))); ?></span>
            <div class="mng-cat-top-feature__title">
                <a href="<?php echo e($featuredItem->url); ?>"><?php echo $featuredItem->title; ?></a>
            </div>
            <p class="mng-cat-top-feature__summary"><?php echo $featuredItem->summary; ?></p>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>


<div id="article-list">
    <?php echo $__env->make($theme->view('partials.article-list'), ['blogs' => $blogs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>


<?php echo $__env->make($theme->view('partials.pagination'), ['paginator' => $blogs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e($theme->js('category.js')); ?>" defer></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('themes.mynewsgh.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/mynewsgh/category.blade.php ENDPATH**/ ?>