<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý phiếu mượn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/quanli.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">BOOK<span style="color: #007bff">LIBRARY</span></div>
            <nav class="nav-links">
                <a href="#">🏠 Trang chủ</a>
                <a href="#">📊 Dashboard</a>
                <a href="#">📚 Quản lý sách</a>
                <a href="{{ route('admin.qlphieumuon') }}" class="active">📄 Quản lý phiếu mượn</a>
                <a href="{{ route('admin.qlmember') }}">👤 Quản lý member</a>
                <a href="#">💰 Quản lý tài chính</a>
            </nav>
            <div class="user-info">
                <img src="https://i.pravatar.cc/40" alt="User">
                <div>
                    <h3>MY UYEN</h3>
    
                </div>
            </div>
        </aside>
        @yield('content')
    </div>
</body>
</html>
