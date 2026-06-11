
<div class="dlt4-pagination" id="dlt4-pagination-container"
     data-current-page="<?php echo e($paginator->currentPage()); ?>"
     data-last-page="<?php echo e($paginator->lastPage()); ?>">

    <?php if($paginator->onFirstPage()): ?>
    <span class="dlt4-pag-disabled">‹</span>
    <?php else: ?>
    <a href="<?php echo e($paginator->previousPageUrl()); ?>" data-page="<?php echo e($paginator->currentPage() - 1); ?>" class="dlt4-page-link">‹</a>
    <?php endif; ?>

    <?php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        $start = max(1, $currentPage - 2);
        $end = min($lastPage, $currentPage + 2);
    ?>

    <?php if($start > 1): ?>
    <a href="<?php echo e($paginator->url(1)); ?>" data-page="1" class="dlt4-page-link">1</a>
    <?php if($start > 2): ?>
    <span class="dlt4-pag-ellipsis">...</span>
    <?php endif; ?>
    <?php endif; ?>

    <?php for($page = $start; $page <= $end; $page++): ?>
    <?php if($page == $currentPage): ?>
    <span class="dlt4-pag-active"><?php echo e($page); ?></span>
    <?php else: ?>
    <a href="<?php echo e($paginator->url($page)); ?>" data-page="<?php echo e($page); ?>" class="dlt4-page-link"><?php echo e($page); ?></a>
    <?php endif; ?>
    <?php endfor; ?>

    <?php if($end < $lastPage): ?>
    <?php if($end < $lastPage - 1): ?>
    <span class="dlt4-pag-ellipsis">...</span>
    <?php endif; ?>
    <a href="<?php echo e($paginator->url($lastPage)); ?>" data-page="<?php echo e($lastPage); ?>" class="dlt4-page-link"><?php echo e($lastPage); ?></a>
    <?php endif; ?>

    <?php if($paginator->hasMorePages()): ?>
    <a href="<?php echo e($paginator->nextPageUrl()); ?>" data-page="<?php echo e($paginator->currentPage() + 1); ?>" class="dlt4-page-link">›</a>
    <?php else: ?>
    <span class="dlt4-pag-disabled">›</span>
    <?php endif; ?>

</div>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/deliddedtech4/partials/pagination.blade.php ENDPATH**/ ?>