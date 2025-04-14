<?php if (isset($component)) { $__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\UserLayout::class, ['categories' => $categories,'recentBorrowers' => $recentBorrowers]); ?>
<?php $component->withName('user-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['danhSachThuVien' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($danhSachThuVien)]); ?>
    <div class="main-content">
        <div class="book-detail">
            <h2><?php echo e($book->book_title); ?></h2>
            <img src="<?php echo e(asset('image/' . $book->file_anh_bia)); ?>" alt="<?php echo e($book->book_title); ?>">
            <p>Tác giả: <?php echo e($book->author); ?></p>
            <p>Nhà xuất bản: <?php echo e($book->nha_xuat_ban); ?></p>
            <p>Năm xuất bản: <?php echo e($book->publication_year); ?></p>
            <p>Mô tả: <?php echo e($book->mo_ta); ?></p>
            <p>Số lượng: <?php echo e($book->total_quantity); ?></p>
            <p>Số lượng còn lại: <?php echo e($book->available_quantity); ?></p>
        </div>
    </div>

    <style>
        .book-detail {
            padding: 20px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .book-detail img {
            max-width: 200px;
            height: auto;
            float: left;
            margin-right: 20px;
        }

        .book-detail h2 {
            margin-top: 0;
        }
    </style>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107)): ?>
<?php $component = $__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107; ?>
<?php unset($__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107); ?>
<?php endif; ?>

<?php /**PATH D:\laravel\QuanLyThuVien-BTN\resources\views/user/book_details.blade.php ENDPATH**/ ?>