<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang cá nhân</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  <style>
    body {
      background-color:rgb(176, 180, 182);
    }

    .navbar {
      font-weight: bold;
      margin-bottom: 0;
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .navbar-nav {
      margin: 0 auto;
    }

    .navbar-nav a {
      color: #333 !important;
    }

    .sidebar {
      position: fixed;
      top: 56px; /* Height of navbar */
      bottom: 0;
      left: 0;
      width: 250px;
      padding-top: 20px;
      background-color:#333;
      color: white;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .sidebar .nav-link {
      color: white !important;
      padding: 10px 20px;
      transition: 0.3s ease;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background-color: #586a92;
      border-radius: 4px;
    }

    .content {
      margin-left: 220px;
      padding: 30px;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .content {
        margin-left: 0;
        padding: 15px;
      }
    }
  </style>
</head>
<body>

  <!-- <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <ul class="navbar-nav">
        
      </ul>
    </div>
  </nav> -->

  <div class="sidebar">
    <ul class="nav flex-column">
    <li class="nav-item active">
          <a class="nav-link" href="{{ url('/') }}">Trang chủ</a>
        </li>
      <li class="nav-item">
        <a class="nav-link active" href="{{ url('/accountpanel') }}">Thông tin tài khoản</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Lịch sử mượn trả sách</a>
      </li>
    </ul>
  </div>

  <main class="content">
    <!-- Nội dung trang quản trị -->
    {{ $slot }}
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
