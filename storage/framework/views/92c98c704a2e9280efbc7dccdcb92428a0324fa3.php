

<?php $__env->startSection('main-content'); ?>
    <style>
        /* Base Styles */
        .book-management {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }
        
        .book-management h1 {
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: 600;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        /* Filter Section */
        .filter-search {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
            align-items: center;
        }
        
        .filter-search label {
            font-weight: 500;
            margin-right: 5px;
        }
        
        .filter-search select,
        .filter-search input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 200px;
        }
        
        /* Table Styles */
        .book-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .book-table th {
            background-color: #3498db;
            color: white;
            padding: 12px 15px;
            text-align: left;
        }
        
        .book-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }
        
        .book-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .book-table tr:hover {
            background-color: #f1f1f1;
        }
        
        /* Button Styles */
        .add-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .add-button:hover {
            background-color: #218838;
        }
        
        .edit-button, .delete-button {
            padding: 5px 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: opacity 0.3s;
            margin-bottom: 5px;
        }
        
        .edit-button {
            background-color: #17a2b8;
            color: white;
            margin-right: 5px;
        }
        
        .delete-button {
            background-color: #dc3545;
            color: white;
        }
        
        .edit-button:hover, .delete-button:hover {
            opacity: 0.8;
        }
        
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .pagination li {
            margin: 0 5px;
            list-style: none;
        }
        
        .pagination a {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #3498db;
            text-decoration: none;
        }
        
        .pagination a:hover {
            background-color: #f1f1f1;
        }
        
        .pagination .active a {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .filter-search {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .book-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>

    <div class="book-management">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div>
            <h1>Quản lý sách</h1>
        </div>
        <div class="filter-search">
            <label for="book-type">Lọc theo loại sách:</label>
            <select id="book-type" onchange="location = this.value;">
                <option value="">Tất cả</option>
                <?php $__currentLoopData = $the_loai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e(url('admin/books/category/' . $category->Id_thể_loại)); ?>" 
                            <?php if(isset($id) && $id == $category->Id_thể_loại): ?> selected <?php endif; ?>>
                        <?php echo e($category->Tên_thể_loại); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <label for="search-book">Tìm kiếm theo tên sách:</label>
            <input type="text" id="search-book" placeholder="Nhập tên sách...">

            <a href="<?php echo e(route('admin.createbook')); ?>"><button class="add-button">Thêm sách</button></a>
        </div>

        <table class="book-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sách</th>
                    <th>Tác giả</th>
                    <th>Thể loại</th>
                    <th>Nhà xuất bản</th>
                    <th>Số lượng</th>
                    <th>Tình trạng sách</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($row->STT); ?></td>
                        <td><?php echo e($row->Tên_sách); ?></td>
                        <td><?php echo e($row->Tác_giả); ?></td>
                        <td><?php echo e($row->Thể_loại); ?></td>
                        <td><?php echo e($row->Nhà_xuất_bản); ?></td>
                        <td><?php echo e($row->Số_lượng_tổng); ?></td>
                        <td>còn <?php echo e($row->Số_lượng_hiện_có); ?> quyển</td>
                        <td>
                            <a href="<?php echo e(route('books.edit', $row->STT)); ?>" class="edit-button"><i class="fas fa-pencil-alt"></i></a>
                            <form action="<?php echo e(route('books.destroy', $row->STT)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="delete-button" onclick="return confirm('Bạn có chắc muốn xóa sách này?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php if(method_exists($books, 'hasPages') && $books->hasPages()): ?>
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($books->links()); ?>

        </div>
        <?php endif; ?>
     
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\QuanLyThuVien-BTN\resources\views/admin/qlysach.blade.php ENDPATH**/ ?>