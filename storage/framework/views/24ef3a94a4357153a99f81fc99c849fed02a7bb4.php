<?php if (isset($component)) { $__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\UserLayout::class, ['categories' => $categories,'recentBorrowers' => $recentBorrowers]); ?>
<?php $component->withName('user-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['danhSachThuVien' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($danhSachThuVien)]); ?>
    <div class="main-content">
        <!-- <div class="header">
            <div class="search-bar">
                <form action="<?php echo e(route('search')); ?>" method="GET">
                    <input type="text" placeholder="Tìm kiếm..." name="search" value="<?php echo e(request('search')); ?>">
                    <button type="submit"> Tìm kiếm</button>
                </form>
            </div>
            
        </div> -->

        <section>
            <h3 class="section-title">Sách được ưa thích nhất</h3>
            <div class="book-list">
                
                <?php $__currentLoopData = $popularBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('book.details', ['id' => $book->book_id])); ?>">

                    <div class="book-item">
                        <img src="<?php echo e(asset('image/' . $book->file_anh_bia)); ?>" alt="<?php echo e($book->book_title); ?>">
                        <p><?php echo e($book->book_title); ?></p>
                        <!-- <p><?php echo e($book->nha_xuat_ban); ?></p> -->
                    </div>
</a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <section>
            <h3 class="section-title">Sách mới thêm gần đây</h3>
            <div class="book-list">
                <?php $__currentLoopData = $newlyAddedBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('book.details', ['id' => $book->book_id])); ?>">

                    <div class="book-item">
                        <img src="<?php echo e(asset('image/' . $book->file_anh_bia)); ?>" alt="<?php echo e($book->book_title); ?>">
                        <p><?php echo e($book->book_title); ?></p>
                        <!-- <p><?php echo e($book->nha_xuat_ban); ?></p> -->
                    </div>
</a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107)): ?>
<?php $component = $__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107; ?>
<?php unset($__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107); ?>
<?php endif; ?>
<?php /**PATH D:\laravel\QuanLyThuVien-BTN\resources\views/user/index.blade.php ENDPATH**/ ?>