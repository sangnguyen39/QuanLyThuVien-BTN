@php use Illuminate\Support\Facades\Auth; @endphp
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/19fd129ae2.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/quanli.css') }}">
    <link href="{{ asset('css/admin/books.css') }}" rel="stylesheet">

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

        .form {
            background-color: #e0e0e0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
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
            grid-template-columns: 1fr;
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
            grid-template-columns: 1fr 1fr;
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
            color: #000;
        }

        .alert {
            padding: 15px;
            background-color: #f9edbe;
            border: 1px solid #f0c36d;
            border-radius: 4px;
            color: #856404;
            margin-bottom: 20px;
        }

        #borrowChart {
            width: 100% !important;
            height: 400px !important;
            border: 1px solid rgb(221, 221, 221);
            display: block;
            /* Đảm bảo canvas là block element */
            box-sizing: border-box;
            /* Đảm bảo không bị ảnh hưởng bởi padding */
        }

        .table-responsive {
            overflow-x: auto;
            /* Cho phép cuộn ngang nếu bảng quá rộng */
        }

        .overdue-table {
            width: 100%;
            border-collapse: collapse;
            /* Loại bỏ khoảng trống giữa các ô */
            margin-top: 10px;
        }

        .overdue-table th,
        .overdue-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            /* Đường viền dưới cho ô */
        }

        .overdue-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }

        .overdue-table tr:nth-child(even) {
            background-color: #f9f9f9;
            /* Đổi màu nền cho hàng chẵn */
        }

        .overdue-table tr:hover {
            background-color: #f1f1f1;
            /* Đổi màu khi di chuột qua hàng */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-title {
            text-align: center;
            /* Căn giữa nội dung tiêu đề */
            margin: 0;
            /* Bỏ margin mặc định */
            font-size: 24px;
            /* Chữ lớn hơn nếu cần */
        }

        .filter-search {
            display: flex;
            align-items: center;
            background-color: #e0e7ff;
            /* Màu nền khối tìm kiếm */
            padding: 10px;
            /* Khoảng cách bên trong */
            border-radius: 8px;
            /* Bo tròn */
            gap: 10px;
            /* Khoảng cách giữa các phần tử */
            margin-bottom: 10px;
        }

        .filter-search label {
            margin-right: 10px;
        }

        .filter-search select,
        .filter-search input[type="text"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .select {
            border: 1px solid #ccc;
            /* Đường viền cho select */
            background-color: #fff;
            /* Nền trắng */
            width: 150px;
            /* Chiều rộng */
        }

        .input[type="text"] {
            border: 1px solid #007bff;
            /* Đường viền xanh */
            outline: none;
            /* Bỏ outline khi focus */
            transition: border-color 0.3s;
            /* Hiệu ứng chuyển màu */
        }

        .filter-search button {
            background-color: #28a745;
            /* Màu nền xanh */
            color: white;
            /* Màu chữ trắng */
            border: none;
            /* Bỏ viền */
            cursor: pointer;
            /* Chuột khi di qua */
            transition: background-color 0.3s;
            /* Hiệu ứng chuyển màu khi hover */
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .add-button {
            background-color: #28a745;
            /* Màu nền xanh */
            color: white;
            /* Màu chữ trắng */
            border: none;
            /* Bỏ viền */
            cursor: pointer;
            /* Chuột khi di qua */
            transition: background-color 0.3s;
            /* Hiệu ứng chuyển màu khi hover */
        }

        .add-button:hover {
            background-color: #218838;
            /* Màu nền khi hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
        }

        .action-buttons button {
            margin: 0 5px;
            padding: 8px 12px;
            border: none;
            background-color: #f0f0f0;
            cursor: pointer;
            border-radius: 4px;
        }

        .action-buttons button:hover {
            background-color: #218838;
            /* Màu nền khi hover */
        }

        .edit-button {
            color: green;
        }

        .delete-button {
            color: red;
        }

        .category-list {
            margin-top: 20px;
            /* Khoảng cách trên */
        }

        .category-list ul {
            list-style-type: none;
            /* Bỏ dấu đầu dòng */
            padding: 0;
            /* Bỏ padding mặc định */
        }

        .category-list li {
            background-color: #f0f8ff;
            /* Màu nền cho mỗi thể loại */
            padding: 5px 10px;
            /* Khoảng cách bên trong */
            border-radius: 4px;
            /* Bo tròn góc cho danh sách */
            margin-bottom: 5px;
            /* Khoảng cách giữa các mục */
        }

        .confirm-btn {
            background-color: green;
            color: white
        }

        .cancel-btn {
            background-color: red;
            color: white;
        }

        .sidebar-container {
            display: flex;
            /* Sử dụng flexbox để sắp xếp sidebar và main content */
            min-height: 100vh;
            /* Đảm bảo chiều cao bằng chiều cao của cửa sổ */
        }

        .logout-button {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .logout-button:hover {
            opacity: 0.8;
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
                <li>
                    <a href="{{ route('admin.index') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <span class="icon-placeholder"><i class="fas fa-chart-bar"></i></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.qlysach') }}"
                        class="{{ request()->is('admin/admin/quanlysach') ? 'active' : '' }}">
                        <span class="icon-placeholder"><i class="fas fa-box"></i></span>
                        <span>Quản lý sách</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.qlphieumuon') }}"
                        class="{{ request()->is('admin/qlphieumuon') ? 'active' : '' }}">
                        <span class="icon-placeholder"><i class="fab fa-wpforms"></i></span>
                        <span>Quản lý phiếu mượn</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.qlmember') }}"
                        class="{{ request()->is('admin/qlmember') ? 'active' : '' }}">
                        <span class="icon-placeholder"><i class="fas fa-user"></i></span>
                        <span>Quản lý sinh viên</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-bottom">
                <img src="placeholder_avatar.png">
                <p>{{ Auth::user()->full_name }}</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('main-content')
        </div>
   
    
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
    @stack('scripts')
</body>

</html>