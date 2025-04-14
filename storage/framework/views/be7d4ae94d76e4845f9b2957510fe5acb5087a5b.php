<div class="book-item">
    <a href="<?php echo e(route('book.details', ['id' => $book->book_id])); ?>">
        <img src="<?php echo e(asset('image/' . $book->file_anh_bia)); ?>" alt="<?php echo e($book->book_title); ?>">
    
    <p><?php echo e($book->book_title); ?></p>
    </a>
</div>
<?php /**PATH D:\laravel\QuanLyThuVien-BTN\resources\views/components/book/card.blade.php ENDPATH**/ ?>