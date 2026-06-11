<?php $__env->startSection('title'); ?><?php echo $seoInfo->seo_title; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?><?php echo $seoInfo->seo_desc; ?><?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e($theme->css('style.css')); ?>?v=1.1">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<?php echo $__env->make($theme->view('partials.home-hero'), ['hotBlogs' => $hotBlogs ?? collect()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="dlt4-home-h1">
    <h1><?php echo e($seoInfo->h1); ?></h1>
</div>


<?php echo $__env->make($theme->view('partials.home-category-sections'), ['categories' => $categories ?? collect(), 'categoryArticles' => $categoryArticles ?? collect()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make($theme->view('partials.home-latest'), ['latestBlogs' => $latestBlogs ?? collect(), 'hotBlogs' => $hotBlogs ?? collect()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('themes.deliddedtech4.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/deliddedtech4/home.blade.php ENDPATH**/ ?>