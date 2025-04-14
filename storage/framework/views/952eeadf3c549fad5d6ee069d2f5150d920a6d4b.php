
<?php $__env->startSection('main-content'); ?>

<div class="main-content">
    <h1>Quản lý phiếu mượn</h1>

    
    

    <div class="tabs">
        <button class="tab <?php echo e($status == 'all' ? 'active' : ''); ?>" 
            onclick="window.location.href='<?php echo e(route('admin.qlphieumuon', ['status' => 'all'])); ?>'">
            Tất cả
        </button>
        <button class="tab <?php echo e($status == 'borrowed' ? 'active' : ''); ?>" 
            onclick="window.location.href='<?php echo e(route('admin.qlphieumuon', ['status' => 'borrowed'])); ?>'">
            Đang mượn
        </button>
        <button class="tab <?php echo e($status == 'returned' ? 'active' : ''); ?>" 
            onclick="window.location.href='<?php echo e(route('admin.qlphieumuon', ['status' => 'returned'])); ?>'">
            Đã trả
        </button>
        <button class="tab <?php echo e($status == 'overdue' ? 'active' : ''); ?>" 
            onclick="window.location.href='<?php echo e(route('admin.qlphieumuon', ['status' => 'overdue'])); ?>'">
            Quá hạn
        </button>
    </div>

    <form method="GET" action="<?php echo e(route('admin.qlphieumuon')); ?>" id="searchForm">
        <div class="input-group mb-3" style="max-width: 400px;">
            <input type="text"
                   class="search-book"
                   name="keyword"
                   style="border-radius:4px"
                   placeholder="Tìm theo mã sinh viên"
                   value="<?php echo e(request('keyword')); ?>"
                   oninput="delayedSubmit()">
        </div>
    </form>

    <table style="width: 100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Mã sinh viên</th>
                <th>Ngày mượn</th>
                <th>Ngày trả</th>
                <th>Hạn trả</th>
                <th>Mã sách</th>
                <th>Chấp nhận/Từ chối</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($data->firstItem() + $index); ?></td>
                <td><?php echo e($item->member->full_name ?? 'Không rõ'); ?></td>
                <td><?php echo e($item->member->student_id ?? 'Không rõ'); ?></td>
                <td><?php echo e($item->borrow_date); ?></td>
                <td><?php echo e($item->due_date); ?></td>
                <td><?php echo e($item->return_date); ?></td>
                <td><?php echo e($item->borrow_id); ?></td>
                <td>
                    <?php if($item->status_book === 'returned'): ?>
                        <span style="color: green;">Đã trả</span>
                    <?php else: ?>
                        <span style="color: red;">Chưa trả</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        <?php echo e($data->links()); ?>

    </div>
</div>
<script>
    let typingTimer;
    function delayedSubmit() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 600); // Chờ 600ms sau khi gõ xong mới gửi
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\QuanLyThuVien-BTN\resources\views/admin/qlphieumuon.blade.php ENDPATH**/ ?>