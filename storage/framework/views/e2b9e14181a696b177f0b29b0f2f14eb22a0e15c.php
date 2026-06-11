
<?php if(isset($categories) && $categories->isNotEmpty()): ?>
<?php
    $sectionColors = ['#f5a500', '#1e88e5', '#43a047', '#1e88e5', '#2d2d2d', '#e8392d', '#7b1fa2', '#00838f'];
?>
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
    $articles = isset($categoryArticles[$category->id]) ? $categoryArticles[$category->id] : collect([]);
    $color = $sectionColors[$index % count($sectionColors)];
?>
<?php if($articles->isNotEmpty()): ?>
<div class="dlt4-cat-section">
    <div class="dlt4-section-header" style="background: <?php echo e($color); ?>;">
        <div class="dlt4-section-title">
            <a href="<?php echo e($category->url); ?>"><?php echo $category->name; ?></a>
        </div>
        <a href="<?php echo e($category->url); ?>" class="dlt4-section-more">More »</a>
    </div>
    <div class="dlt4-cat-section-body">

        
        <div class="dlt4-cat-main">
            <?php $featured = $articles->first(); ?>
            <?php if($featured): ?>
            <div class="dlt4-home-featured-card">
                <a href="<?php echo e($featured->url); ?>">
                    <img src="<?php echo e($featured->head_img); ?>" alt="<?php echo e($featured->head_img_alt); ?>" class="dlt4-home-featured-card-img" loading="lazy">
                </a>
                <div class="dlt4-home-featured-card-overlay">
                    <a href="<?php echo e($featured->category ? $featured->category->url : '#'); ?>" class="dlt4-home-featured-card-cat"><?php echo $featured->category_name; ?></a>
                    <div class="dlt4-home-featured-card-title">
                        <a href="<?php echo e($featured->url); ?>"><?php echo $featured->title; ?></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="dlt4-cat-small-list">
                <?php $__currentLoopData = $articles->skip(1)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="dlt4-cat-small-item">
                    <div class="dlt4-cat-small-item-img">
                        <a href="<?php echo e($item->url); ?>">
                            <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" loading="lazy">
                        </a>
                    </div>
                    <div>
                        <div class="dlt4-cat-small-item-title">
                            <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
                        </div>
                        <div class="dlt4-cat-small-item-date"><?php echo e(date('M j, Y', strtotime($item->published_at))); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="dlt4-home-cat-grid">
            <?php $__currentLoopData = $articles->skip(4)->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="dlt4-home-list-card">
                <a href="<?php echo e($item->url); ?>">
                    <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" class="dlt4-home-list-card-img" loading="lazy">
                </a>
                <div class="dlt4-home-list-card-body">
                    <a href="<?php echo e($item->category ? $item->category->url : '#'); ?>" class="dlt4-home-list-card-cat"><?php echo $item->category_name; ?></a>
                    <div class="dlt4-home-list-card-title">
                        <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
                    </div>
                    <div class="dlt4-home-list-card-date"><?php echo e(date('M j, Y', strtotime($item->published_at))); ?></div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/deliddedtech4/partials/home-category-sections.blade.php ENDPATH**/ ?>