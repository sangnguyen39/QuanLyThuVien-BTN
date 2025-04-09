@php use Illuminate\Support\Facades\Auth; @endphp
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/19fd129ae2.js" crossorigin="anonymous"></script>
    <title>BOOKLIBRARY - Dashboard</title>
    <style>
        /* Basic CSS */
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
            display: flex;
            min-height: 100vh;
        }

        .sidebar-container {
            display: flex;
            /* Sử dụng flexbox để sắp xếp nút và sidebar */
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            padding: 10px;
            margin-right: 10px;

            /* Tạo khoảng cách với sidebar */
        }

        .sidebar {
            width: 250px;
            /* Độ rộng ban đầu của sidebar */
            background-color: #f0f0f0;
            padding: 20px;
            transition: width 0.3s ease;
            overflow-x: hidden;
            display: flex;
            /* Thêm display flex để căn chỉnh các phần tử con */
            flex-direction: column;
            /* Sắp xếp các phần tử con theo chiều dọc */
        }

        .sidebar>*:first-child {
            /* Chọn phần tử con đầu tiên của sidebar (là button) */
            margin-bottom: 20px;
            /* Tạo khoảng cách với h2 */
        }

        .sidebar.collapsed {
            width: 60px;
            /* Độ rộng khi thu gọn */
        }

        .sidebar h2 {
            margin-bottom: 20px;
        }

        .sidebar-header {
            display: flex;
            /* Sử dụng flexbox cho container này */
            align-items: center;
            /* Căn chỉnh các phần tử theo chiều dọc ở giữa */
            margin-bottom: 20px;
            /* Tạo khoảng cách với menu */
        }

        .sidebar-header .toggle-btn {
            margin-right: 10px;
            font-size: 24px;
            /* Tạo khoảng cách giữa button và h2 */
        }

        .sidebar-header h2 {
            margin-bottom: 0;
            font-size: 24px;
            /* Loại bỏ margin-bottom mặc định của h2 trong header */
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            padding: 10px 0;
        }

        .sidebar li a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            padding: 8px 15px;
            border-radius: 5px;
        }

        .sidebar li a.active {
            background-color: #e9ecef;
            color: #007bff;
        }

        .sidebar li a i {
            margin-right: 10px;
            font-size: 1.2em;
        }

        .sidebar ul li a span.icon-placeholder {
            margin-right: 10px;
            min-width: 20px;
            /* Đảm bảo icon không bị co lại khi chữ ẩn */
            text-align: center;
            /* Canh giữa icon */
        }

        /* Ẩn chữ khi sidebar bị thu gọn */
        .sidebar.collapsed h2,
        .sidebar.collapsed .sidebar-bottom p,
        .sidebar.collapsed .sidebar-bottom a,
        .sidebar.collapsed ul li a>*:not(.icon-placeholder) {
            /* Chọn tất cả các phần tử con của a TRỪ .icon-placeholder */
            display: none;
        }

        .sidebar.collapsed ul li a {
            justify-content: center;
            /* Canh giữa icon khi không có chữ */
            padding: 15px 0;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
        }

        .sidebar-bottom img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 5px;
        }

        /* Cập nhật kích thước ảnh sidebar-bottom khi thu gọn */
        .sidebar.collapsed .sidebar-bottom img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .sidebar-bottom p {
            margin: 0;
            font-size: 0.9em;
            color: #555;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .top-bar h1 {
            margin: 0;
            font-size: 1.5em;
            color: #333;
        }

        .date-navigation button {
            padding: 8px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer;
            margin-left: 5px;
        }

        .date-navigation button.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .kpi-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
        }

        .kpi-card h3 {
            margin-top: 0;
            font-size: 1em;
            color: #555;
            margin-bottom: 5px;
        }

        .kpi-card .value {
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
        }

        .kpi-card .icon {
            font-size: 2em;
            color: #007bff;
            margin-bottom: 10px;
        }

        .chart-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .chart-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .chart-card h3 {
            margin-top: 0;
            font-size: 1.2em;
            color: #333;
            margin-bottom: 10px;
        }

        .filter-bar {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 15px;
        }

        .filter-bar label {
            font-size: 0.9em;
            color: #555;
        }

        .filter-bar select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .data-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
        }

        .data-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .data-card h3 {
            margin-top: 0;
            font-size: 1.2em;
            color: #333;
            margin-bottom: 10px;
        }

        .data-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .data-list li {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .data-list li:last-child {
            border-bottom: none;
        }

        .data-list .label {
            color: #555;
        }

        .data-list .value {
            font-weight: bold;
            color: #333;
        }

        /* Basic icon styling */
        /* Basic icon styling */
        .icon-placeholder {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: transparent;
            /* Thay đổi thành transparent */
            border-radius: 3px;
            margin-right: 5px;
            text-align: center;
            line-height: 20px;
            font-size: 1.2em;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <button class="toggle-btn"><i class="fa-solid fa-bars"></i></button>
            <h2>BOOKLIBRARY</h2>
        </div>
        <ul>
            <li><a href="#"><span class="icon-placeholder">🏠</span> <span>Trang chủ</span></a></li>
            <li><a href="#" class="active"><span class="icon-placeholder">📊</span> <span>Dashboard</span></a></li>
            <li><a href="#"><span class="icon-placeholder">📚</span> <span>Quản lý sách</span></a></li>
            <li><a href="#"><span class="icon-placeholder">💳</span> <span>Quản lý phiếu mượn</span></a></li>
            <li><a href="#"><span class="icon-placeholder">🧑‍💼</span> <span>Quản lý nhân viên</span></a></li>
            <li><a href="#"><span class="icon-placeholder">💰</span> <span>Quản lý tài chính</span></a></li>
        </ul>
        <div class="sidebar-bottom">
            <img src="placeholder_avatar.png" >
            <p>{{Auth::user()->full_name}}</p>
            <a href="#"><span>Đăng xuất</span></a>
        </div>
    </div>

    <!-- Main Content -->
   @yield('main-content')

    <script>

        // Basic JavaScript for potential interactivity
        const dateButtons = document.querySelectorAll('.date-navigation button');
        dateButtons.forEach(button => {
            button.addEventListener('click', function () {
                dateButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                // Add logic to update data based on the selected date range
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.querySelector('.toggle-btn');
            const sidebar = document.querySelector('.sidebar');

            toggleBtn.addEventListener('click', function () {
                sidebar.classList.toggle('collapsed');
            });
        });
        // You would add JavaScript here to:
        // 1. Fetch and display data dynamically.
        // 2. Implement the charts using a charting library.
        // 3. Handle interactions with filters and other elements.
    </script>
</body>

</html>