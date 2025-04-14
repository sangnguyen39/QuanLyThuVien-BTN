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
<?php if (isset($component)) { $__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\UserLayout::class, ['categories' => $categories,'recentBorrowers' => $recentBorrowers]); ?>
<?php $component->withName('user-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?> 
    <div class="main-content"> 
        <div class="book-detail"> 
            <h2><?php echo e($book->book_title); ?></h2> 
            <div class="book-info"> 
                <img src="<?php echo e(asset('image/' . $book->file_anh_bia)); ?>" alt="<?php echo e($book->book_title); ?>"> 

                <div class="book-meta"> 
                    <p><strong>Tác giả:</strong> <?php echo e($book->author); ?></p> 
                    <p><strong>Nhà xuất bản:</strong> <?php echo e($book->nha_xuat_ban); ?></p> 
                    <p><strong>Năm xuất bản:</strong> <?php echo e($book->publication_year); ?></p> 
                    <p><strong>Mô tả:</strong> <?php echo e($book->mo_ta); ?></p> 

                    <div class="quantity-info">
                        <p><strong>Số lượng:</strong> <?php echo e($book->total_quantity); ?></p> 
                        <p><strong>Số lượng còn lại:</strong> <?php echo e($book->available_quantity); ?> 
                            <?php if($book->available_quantity > 0): ?>
                                <span class="available-badge">Còn sách</span>
                            <?php else: ?>
                                <span class="unavailable-badge">Hết sách</span>
                            <?php endif; ?>
                        </p>
                    </div>

                    <?php if($book->available_quantity > 0): ?>
                        <div class="borrow-form">
                            <button type="button" class="btn-primary" id="showBorrowFormBtn">Mượn sách</button>
                        </div>
                    <?php else: ?>
                        <div class="alert-warning">
                            Sách hiện không có sẵn để mượn.
                        </div>
                    <?php endif; ?>
                </div> 
            </div> 
        </div> 
    </div>

    <!-- Modal Form Mượn Sách -->
    <div id="borrowModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Thông tin mượn sách</h2>

            <!-- Hiển thị thông báo -->
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php elseif(session('error')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('book.borrow', $book->book_id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="borrower_name">Tên người mượn:</label>
                    <input type="text" id="borrower_name" name="borrower_name" class="form-control" value="<?php echo e(Auth::user()->name ?? ''); ?>" readonly>
                </div>
                
                <div class="form-group">
                    <label for="borrower_email">Email:</label>
                    <input type="email" id="borrower_email" name="borrower_email" class="form-control" value="<?php echo e(Auth::user()->email ?? ''); ?>" readonly>
                </div>
                
                <div class="form-group">
                    <label for="borrow_date">Ngày mượn:</label>
                    <input type="text" id="borrow_date" name="borrow_date" class="form-control" value="<?php echo e(date('d/m/Y')); ?>" readonly>
                </div>
                
                <div class="form-group">
                    <label for="return_date">Hạn trả:</label>
                    <input type="text" id="return_date" name="return_date" class="form-control" value="<?php echo e(date('d/m/Y', strtotime('+30 days'))); ?>" readonly>
                </div>
                
                
                <div class="form-group">
                    <label for="book_title">Tên sách:</label>
                    <input type="text" id="book_title" name="book_title" class="form-control" value="<?php echo e($book->book_title); ?>" readonly>
                </div>
                
                <div class="form-group">
                    <label for="author">Tên tác giả:</label>
                    <input type="text" id="author" name="author" class="form-control" value="<?php echo e($book->author); ?>" readonly>
                </div>
                
                <div class="form-group">
                    <label for="quantity">Số lượng:</label>
                    <select id="quantity" name="quantity" class="form-control">
                        <?php for($i = 1; $i <= min(4, $book->available_quantity); $i++): ?>
                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="warning-note">
                    <p><strong>Lưu ý:</strong> ⚠️ Vui lòng giữ gìn sách cẩn thận và trả đúng hạn. Nếu trả trễ sẽ phải đóng phí theo quy định.</p>
                </div>
                
                <div class="form-action">
                    <button type="submit" class="btn-primary">Xác nhận mượn sách</button>
                    <button type="button" class="btn-cancel" id="cancelBtn">Hủy</button>
                </div>
            </form>
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

    /* Reset và thiết lập chung */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Roboto', 'Segoe UI', sans-serif;
      background-color: #f4f7fb;
      color: #333;
      line-height: 1.7;
    }

    /* Main content container */
    .main-content {
      max-width: 1200px;
      margin: 30px auto;
      padding: 0 20px;
    }

    /* Phần chi tiết sách - style mới */
    .book-detail {
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .book-detail:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    /* Tiêu đề sách (header mới) */
    .book-detail h2 {
      background: linear-gradient(135deg, #00b4d8, #0077b6);
      color: white;
      padding: 25px 35px;
      font-size: 28px;
      font-weight: 700;
      letter-spacing: 0.5px;
      margin: 0;
      text-align: center;
      border-radius: 15px 15px 0 0;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Layout hình ảnh và thông tin */
    .book-info {
      display: flex;
      padding: 25px;
      gap: 30px;
      flex-wrap: wrap;
    }

    /* Hình ảnh sách */
    .book-info img {
      width: 280px;
      height: auto;
      border-radius: 10px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
      object-fit: contain;
      transition: all 0.3s ease;
      flex-shrink: 0;
      align-self: flex-start;
      max-height: 400px;
    }

    .book-info img:hover {
      transform: scale(1.03);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    /* Thông tin chi tiết */
    .book-meta {
      flex: 1;
      min-width: 300px;
    }

    .book-meta p {
      margin-bottom: 15px;
      padding-bottom: 10px;
      border-bottom: 1px solid #e9ecef;
      font-size: 16px;
    }

    .book-meta p:last-child {
      border-bottom: none;
    }

    .book-meta p strong {
      color: #0077b6;
      font-weight: 600;
      margin-right: 8px;
      display: inline-block;
      min-width: 120px;
    }

    /* Hiển thị số lượng */
    .quantity-info {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 10px;
    }

    .quantity-info p {
      margin-bottom: 5px;
      border-bottom: none;
    }

    /* Badge cho số lượng còn */
    .available-badge {
      display: inline-block;
      background-color: #10b981;
      color: white;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 500;
      margin-left: 10px;
    }

    .unavailable-badge {
      display: inline-block;
      background-color: #ef4444;
      color: white;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 500;
      margin-left: 10px;
    }

    /* Form mượn sách */
    .borrow-form {
      margin-top: 20px;
    }

    /* Button style */
    .btn-primary, .btn-borrow, button[type="submit"] {
      background: linear-gradient(135deg, #00b4d8, #0077b6);
      color: white;
      border: none;
      padding: 12px 25px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .btn-primary:hover, .btn-borrow:hover, button[type="submit"]:hover {
      background: linear-gradient(135deg, #0077b6, #00b4d8);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 180, 216, 0.3);
    }

    .btn-primary:active, .btn-borrow:active, button[type="submit"]:active {
      transform: translateY(0);
      box-shadow: none;
    }

    .btn-cancel {
      background: #64748b;
      color: white;
      border: none;
      padding: 12px 25px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      margin-left: 10px;
    }

    .btn-cancel:hover {
      background: #475569;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(100, 116, 139, 0.3);
    }

    /* Thông báo */
    .alert-warning {
      padding: 15px 20px;
      border-radius: 8px;
      font-weight: 500;
      display: flex;
      align-items: center;
      margin: 15px 0;
      background-color: #fef3c7;
      border-left: 4px solid #f59e0b;
      color: #92400e;
    }

    .alert-warning::before {
      content: "⚠️";
      margin-right: 15px;
      font-size: 20px;
    }

    /* Modal CSS */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 5% auto;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      width: 80%;
      max-width: 600px;
      animation: modalFadeIn 0.3s;
    }

    @keyframes  modalFadeIn {
      from {opacity: 0; transform: translateY(-50px);}
      to {opacity: 1; transform: translateY(0);}
    }

    .close-button {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.2s;
    }

    .close-button:hover {
      color: #0077b6;
    }

    .modal-content h2 {
      margin-bottom: 20px;
      color: #0077b6;
      text-align: center;
      font-size: 24px;
    }

    /* Form styling */
    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      color: #475569;
    }

    .form-control {
      width: 100%;
      padding: 10px 15px;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      font-size: 16px;
      transition: all 0.3s;
    }

    .form-control:focus {
      outline: none;
      border-color: #0077b6;
      box-shadow: 0 0 0 3px rgba(0, 119, 182, 0.2);
    }

    .form-control[readonly] {
      background-color: #f1f5f9;
      cursor: not-allowed;
    }

    .warning-note {
      background-color: #fef3c7;
      border-left: 4px solid #f59e0b;
      padding: 15px;
      margin: 20px 0;
      border-radius: 8px;
    }

    .warning-note p {
      color: #92400e;
      margin: 0;
    }

    .form-action {
      display: flex;
      justify-content: center;
      margin-top: 25px;
    }

    /* Footer */
    .footer {
      background-color: #333;
      color: white;
      padding: 30px;
      margin-top: 40px;
      text-align: center;
    }

    .footer-content {
      max-width: 1200px;
      margin: 0 auto;
    }

    .footer-info {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .footer-info h3 {
      font-size: 25px;
      margin-bottom: 15px;
    }

    .footer-info p {
      font-size: 25px;
      margin: 5px 0;
    }

    /* Responsive adjustments */
    @media (max-width: 991px) {
      .book-info {
        flex-direction: column;
        align-items: center;
      }

      .book-info img {
        width: 250px;
        margin-bottom: 20px;
      }

      .book-meta {
        width: 100%;
      }
      
      .modal-content {
        width: 90%;
        margin: 10% auto;
      }
    }

    @media (max-width: 768px) {
      .book-detail h2 {
        padding: 20px;
        font-size: 24px;
      }
      
      .book-info {
        padding: 15px;
      }

      .book-info img {
        width: 220px;
      }
      
      .quantity-info {
        flex-direction: column;
        gap: 5px;
      }
      
      .form-action {
        flex-direction: column;
        gap: 10px;
      }
      
      .btn-cancel {
        margin-left: 0;
      }
    }
    /* Thông báo thành công */
.alert-success {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
}

/* Thông báo lỗi */
.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
}
 /* Thông báo thành công */
 .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        /* Thông báo lỗi */
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        /* Modal CSS */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 600px;
            animation: modalFadeIn 0.3s;
        }

        @keyframes  modalFadeIn {
            from {opacity: 0; transform: translateY(-50px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
        }

        .close-button:hover {
            color: #0077b6;
        }

    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    // Lấy modal
    const modal = document.getElementById('borrowModal');
    
    // Lấy nút mở modal
    const btn = document.getElementById('showBorrowFormBtn');
    
    // Lấy phần tử để đóng modal
    const closeBtn = document.getElementsByClassName('close-button')[0];
    const cancelBtn = document.getElementById('cancelBtn');
    
    // Kiểm tra xem có thông báo không để quyết định có mở modal khi trang tải hay không
    const hasSuccessMessage = document.querySelector('.alert-success');
    const hasErrorMessage = document.querySelector('.alert-danger');
    
    if (hasSuccessMessage || hasErrorMessage) {
        modal.style.display = 'block';
        
        // Nếu là thông báo thành công, tự động đóng modal sau 3 giây
        if (hasSuccessMessage) {
            setTimeout(function() {
                modal.style.display = 'none';
            }, 3000);
        }
    }
    
    // Khi người dùng nhấn nút, mở modal
    btn.addEventListener('click', function() {
        modal.style.display = 'block';
    });
    
    // Khi người dùng nhấn nút đóng, đóng modal
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    
    // Khi người dùng nhấn nút Hủy, đóng modal
    cancelBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    
    // Khi người dùng nhấn ra ngoài modal, đóng modal
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});
    
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107)): ?>
<?php $component = $__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107; ?>
<?php unset($__componentOriginal1c033872f6702129cc9a9b857a6606a850d68107); ?>
<?php endif; ?>
<?php /**PATH D:\laravel\QuanLyThuVien-BTN\resources\views/user/book_details.blade.php ENDPATH**/ ?>