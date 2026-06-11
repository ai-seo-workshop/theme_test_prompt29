
<?php if(isset($featuredItems) && $featuredItems->isNotEmpty()): ?>
<?php $mainItem = $featuredItems->first(); $smallItems = $featuredItems->skip(1)->take(4); ?>
<div class="dlt4-cat-hero">

    
<?php if($mainItem): ?>
    <div class="dlt4-cat-hero-main">
        <a href="<?php echo e($mainItem->url); ?>">
            <img src="<?php echo e($mainItem->head_img); ?>" alt="<?php echo e($mainItem->head_img_alt); ?>" class="dlt4-cat-hero-main-img" loading="eager">
        </a>
        <div class="dlt4-cat-hero-main-overlay">
            <a href="<?php echo e($mainItem->category ? $mainItem->category->url : '#'); ?>" class="dlt4-cat-hero-main-cat"><?php echo $mainItem->category_name; ?></a>
            <div class="dlt4-cat-hero-main-title">
                <a href="<?php echo e($mainItem->url); ?>"><?php echo $mainItem->title; ?></a>
            </div>
            <div class="dlt4-cat-hero-main-date"><?php echo e(date('M j, Y', strtotime($mainItem->published_at))); ?></div>
        </div>
    </div>
<?php endif; ?>

    
<?php $__currentLoopData = $smallItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="dlt4-cat-hero-small">
        <a href="<?php echo e($item->url); ?>">
            <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" class="dlt4-cat-hero-small-img" loading="lazy">
        </a>
        <div class="dlt4-cat-hero-small-overlay">
            <a href="<?php echo e($item->category ? $item->category->url : '#'); ?>" class="dlt4-cat-hero-small-cat"><?php echo $item->category_name; ?></a>
            <div class="dlt4-cat-hero-small-title">
                <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php endif; ?>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/deliddedtech4/partials/category-featured.blade.php ENDPATH**/ ?>