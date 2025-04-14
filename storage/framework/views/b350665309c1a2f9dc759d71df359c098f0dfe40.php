
<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(asset('css/admin/books.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>

    <main class="main-content">
        <div class="book-management">
            <h1>Quản lý member </h1>

            <form method="GET" action="<?php echo e(route('admin.qlmember')); ?>" id="searchForm">
                <div class="input-group mb-3" style="max-width: 400px;">
                    <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm theo mã sinh viên..."
                        value="<?php echo e(request('keyword')); ?>" oninput="delayedSubmit()">
                </div>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ và tên</th>
                        <th>Mã sinh viên</th>
                        <th>Email</th>
                        <th>Lớp </th>
                        <th>Khóa</th>
                        <th style="text-align: center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                        <tr>
                            <td><?php echo e($data->firstItem() + $index); ?></td>
                            <td><?php echo e($item->full_name ?? 'Không rõ'); ?></td>
                            <td><?php echo e($item->student_id ?? 'Không rõ'); ?></td>
                            <td><?php echo e($item->email); ?></td>
                            <td><?php echo e($item->class); ?></td>
                            <td><?php echo e($item->course_year); ?></td>
                            <td style="text-align: center">

                                <form action="<?php echo e(route('admin.member.destroy', $item->member_id)); ?>" method="POST"
                                    style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button style="width: 100px" type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                <?php echo e($data->links()); ?>

            </div>
    </main>
    <script>
        let typingTimer;
        function delayedSubmit() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                document.getElementById('searchForm').submit();
            }, 600);
        }
    </script>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\QuanLyThuVien-BTN\resources\views/admin/qlmember.blade.php ENDPATH**/ ?>