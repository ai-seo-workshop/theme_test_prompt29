<?php $__env->startSection('title'); ?><?php echo $seoInfo->seo_title; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?><?php echo $seoInfo->seo_desc; ?><?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e($theme->css('drift.css')); ?>?v=1.1">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<?php echo $__env->make($theme->view('partials.breadcrumb'), ['items' => [
    ['url' => app()->getLocale() === config('app.default_language') ? '/' : '/'.app()->getLocale().'/', 'name' => trans_theme('home')],
    ['url' => null, 'name' => $categoryInfo->name]
]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="dlt4-container">

    <section class="dlt4-list-section">

        <h1 class="dlt4-cat-title"><?php echo $categoryInfo->name; ?></h1>

        <?php if(!empty($seoInfo->content)): ?>
        <p class="dlt4-cat-desc"><?php echo strip_tags($seoInfo->content); ?></p>
        <?php endif; ?>

        <?php $allItems = collect($blogs->items()); ?>

        
        <?php echo $__env->make($theme->view('partials.category-featured'), ['featuredItems' => $sidebarRecommended->take(5)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <div class="dlt4-widget-title"><?php echo e(trans_theme('recent_posts')); ?></div>
        <div class="dlt4-list-grid" id="dlt4-article-list">
            <?php echo $__env->make($theme->view('partials.article-list'), ['blogs' => $blogs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        
        <?php echo $__env->make($theme->view('partials.pagination'), ['paginator' => $blogs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </section>

    
    <?php echo $__env->make($theme->view('partials.sidebar'), ['sidebarPopular' => $sidebarPopular ?? collect(), 'sidebarRecommended' => collect()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e($theme->js('category.js')); ?>" defer></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('themes.deliddedtech4.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/deliddedtech4/category.blade.php ENDPATH**/ ?>