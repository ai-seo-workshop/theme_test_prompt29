
<?php if($paginator->lastPage() > 1): ?>
<div class="mng-pagination" id="pagination-container"
     data-current-page="<?php echo e($paginator->currentPage()); ?>"
     data-last-page="<?php echo e($paginator->lastPage()); ?>">

<?php if($paginator->onFirstPage()): ?>
    <span class="mng-page-disabled">&#8249;</span>
<?php else: ?>
    <a href="javascript:void(0)" data-page="<?php echo e($paginator->currentPage() - 1); ?>" class="page-link">&#8249;</a>
<?php endif; ?>

    <?php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        $start = max(1, $current - 2);
        $end = min($last, $current + 2);
    ?>

<?php if($start > 1): ?>
    <a href="javascript:void(0)" data-page="1" class="page-link">1</a>
<?php if($start > 2): ?>
    <span class="mng-ellipsis">...</span>
<?php endif; ?>
<?php endif; ?>

<?php for($p = $start; $p <= $end; $p++): ?>
<?php if($p == $current): ?>
    <span class="mng-page-active"><?php echo e($p); ?></span>
<?php else: ?>
    <a href="javascript:void(0)" data-page="<?php echo e($p); ?>" class="page-link"><?php echo e($p); ?></a>
<?php endif; ?>
<?php endfor; ?>

<?php if($end < $last): ?>
<?php if($end < $last - 1): ?>
    <span class="mng-ellipsis">...</span>
<?php endif; ?>
    <a href="javascript:void(0)" data-page="<?php echo e($last); ?>" class="page-link"><?php echo e($last); ?></a>
<?php endif; ?>

<?php if($paginator->hasMorePages()): ?>
    <a href="javascript:void(0)" data-page="<?php echo e($paginator->currentPage() + 1); ?>" class="page-link">&#8250;</a>
<?php else: ?>
    <span class="mng-page-disabled">&#8250;</span>
<?php endif; ?>

</div>
<?php endif; ?>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/mynewsgh/partials/pagination.blade.php ENDPATH**/ ?>