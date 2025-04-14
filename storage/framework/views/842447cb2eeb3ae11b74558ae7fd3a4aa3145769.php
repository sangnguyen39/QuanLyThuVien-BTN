<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thông báo</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .message-box {
      background-color:rgb(178, 215, 244);
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 500px;
    }

    .message-box h3 {
      color: #333;
      margin-bottom: 20px;
    }

    .message-box a {
      margin: 5px;
    }
  </style>
</head>
<body>

  <div class="message-box">
    <h3>Bị lỗi? Không mượn được sách?</h3>
    <p>Vui lòng đăng nhập để tiếp tục.</p>
    <a href="<?php echo e(url('/login')); ?>" class="btn btn-primary">Đăng nhập</a>
    <p class="mt-3">Chưa có tài khoản?</p>
    <a href="<?php echo e(url('/register')); ?>" class="btn btn-outline-secondary">Đăng ký ngay</a><br>
    <a href="/">Quay lại thư viện</a>

  </div>

</body>
</html>
<?php /**PATH D:\laravel\QuanLyThuVien-BTN\resources\views/user/huongdan.blade.php ENDPATH**/ ?>