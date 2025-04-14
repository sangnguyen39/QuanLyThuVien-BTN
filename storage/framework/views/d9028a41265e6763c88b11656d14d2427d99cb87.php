
<?php if (isset($component)) { $__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\UserLayout::class, ['categories' => $categories,'recentBorrowers' => $recentBorrowers]); ?>
<?php $component->withName('user-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['danhSachThuVien' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($danhSachThuVien)]); ?>

    <div class="main-content">
        <h4>Kết quả tìm kiếm cho "<?php echo e($searchTerm); ?>"</h4><br>

        <?php if($books->count() > 0): ?>
            <div class="book-list">
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('book.details', ['id' => $book->book_id])); ?>">

                    <div class="book-item">
                        <img src="<?php echo e(asset('image/' . $book->file_anh_bia)); ?>" alt="<?php echo e($book->book_title); ?>">
                        <p><?php echo e($book->book_title); ?></p>
                    </div>
</a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p>Không tìm thấy sách nào.</p>
        <?php endif; ?>
    </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107)): ?>
<?php $component = $__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107; ?>
<?php unset($__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107); ?>
<?php endif; ?>
<?php /**PATH D:\laravel\QuanLyThuVien-BTN\resources\views/user/search_results.blade.php ENDPATH**/ ?>