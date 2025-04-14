<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>BOOKLIBRARY</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    
    <style>
        /* Cho màn hình nhỏ hơn hoặc bằng 768px (ví dụ: tablet) */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                /* Chuyển sidebar lên trên main content */
                padding: 10px;
                margin: 10px;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #ddd;
                padding-right: 0;
                padding-bottom: 15px;
                margin-bottom: 15px;
            }

            .main-content {
                padding-left: 0;
            }

            .book-list {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                /* Thu nhỏ kích thước cột sách */
                gap: 10px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-bar {
                margin-bottom: 10px;
                width: 100%;
            }

            .search-bar input[type="text"] {
                width: 100%;
            }

            .user-info {
                margin-top: 10px;
            }
        }

        /* Cho màn hình nhỏ hơn hoặc bằng 480px (ví dụ: điện thoại) */
        @media (max-width: 480px) {
            .book-list {
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                /* Thu nhỏ hơn nữa */
            }

            .section-title {
                font-size: 1.2em;
            }
        }

        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 1300px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        .sidebar {
            width: 200px;
            padding-right: 20px;
            border-right: 1px solid #ddd;
        }

        .sidebar h2 {
            margin-top: 0;
            color: #007bff;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            padding: 5px 0;
        }

        .sidebar li a {
            text-decoration: none;
            color: #333;
            display: block;
        }

        .sidebar li a:hover {
            color: #007bff;
        }

        .main-content {
            flex-grow: 1;
            padding-left: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-bar input[type="text"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info span {
            margin-right: 10px;
        }

        .user-info button {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .section-title {
            font-size: 1.5em;
            margin-bottom: 15px;
            color: #333;
        }

       
        .book-list {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* 5 cột đều nhau */
    gap: 15px; /* khoảng cách giữa các sách */
    margin-bottom: 40px;
    padding-right: 20px;

}

.book-item {
    background-color: #fff;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    cursor: pointer;
    display: flex;
    flex-direction: column;

    height: 100%;
    border: 1px solid #eee;
}

.book-item:hover {
    transform: translateY(-6px);
}

.book-item img {
    width: 100%;
    height: 245px;
    object-fit: cover;
    display: block;
}

.book-item p {
    padding: 8px 10px;
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    text-align: center;
    flex-grow: 1;
    margin: 0;
}


        /* .see-all {
            color: #007bff;
            cursor: pointer;
            display: block;
            margin-top: 10px;
        } */

        .readers-list {
            margin-top: 20px;
        }

        .reader-item {
            display: flex;
            align-items: center;
            padding: 5px 0;
        }

        .reader-item img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

    </style>
    <style>
    /* Định dạng màu nền và màu chữ của menu */
    .navbar {
        background-color: rgba(240, 238, 245, 0.93);
        max-width: 1300px;
        font-weight: bold;
        margin: 0 auto;
    }

    .nav-item a {
        color: #fff !important;
    }

    

    .banner-navbar {
        height: 150px;
        background-image: url('/images/banner.jpg');
        background-size: cover;
        background-position: center;
        color: white;
        position: relative;
    }

    /* CSS cho khối login/register/dropdown ở góc dưới bên phải */
    .auth-box {
        position: absolute;
        bottom: 10px;
        right: 20px;
    }

    .auth-box button {
        margin-left: 5px;
        background-color: rgba(14, 1, 1, 0.9);
    }
    /*  */
    

</style>

<header>
    <nav class="navbar navbar-light navbar-expand-sm banner-navbar">
        <div class="container-fluid">
            <!-- <div class="col-12">
                <a class="navbar-brand text-white fw-bold" href="{{ url('/') }}">Thư viện Hub</a>
            </div> -->
            <div class="auth-box">
                @auth
                    <div class="dropdown">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->username }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('account') }}">Thông tin</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Đăng xuất
                                </a>
                            </form>
                        </div>
                    </div>
                    
                @else
                    <a href="{{ route('auth.showlogin') }}">
                        <button class="btn btn-sm btn-primary">Đăng nhập</button>
                    </a>
                    <a href="{{ route('auth.register') }}">
                        <button class="btn btn-sm btn-success">Đăng ký</button>
                    </a>
                @endauth
            </div>

        </div>
    </nav>
</header>

<style> 
/* thể loại */
    .module-title {
    background-color: black;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    margin-bottom: 20px;
    display: inline-block;
    min-width: 175px; /* Đặt chiều rộng tối thiểu cho hộp */
    width: 175px;
    min-height: 40px; /* Đặt chiều cao tối thiểu cho hộp */
    box-sizing: border-box; /* Đảm bảo padding không làm tăng kích thước tổng thể */
}

.sidebar a .booklibrary-title {
    text-decoration: none;
}

.sidebar a .booklibrary-title:hover,
.sidebar .category-title:hover {
    background-color: #333;
    cursor: pointer;
}

/* Стиль riêng cho BOOKLIBRARY  */
.sidebar a .booklibrary-title {
    font-size: 1.2em;
}

/* Стиль riêng cho "Thể loại"  */
.sidebar .category-title {
    font-size: 1.2em;
}
/* danh sách thể loại */
.category-dropdown {
    position: relative; /* Để định vị tuyệt đối cho danh sách */
}

.category-dropdown .category-list {
    display: none; /* Ẩn danh sách ban đầu */
    position: absolute;
    top: 100%;
    left: 0;
    /* Loại bỏ background-color đen của khung */
    background-color: black;
    border: none; /* Loại bỏ viền */
    border-radius: 0;
    z-index: 10;
    width: auto; /* Điều chỉnh độ rộng theo nội dung */
    box-shadow: none; /* Loại bỏ bóng đổ */
    padding: 0;
    list-style-type: none;
    margin: 0;

}
.category-dropdown .category-list li:first-child a {
    border-top-left-radius: 8px; 
}


.category-dropdown:hover .category-list {
    display: block; /* Hiển thị danh sách khi hover vào .category-dropdown */
}

.category-dropdown .category-list li a {
    display: block;
    padding: 2px 15px; /* Giảm padding cho phù hợp */
    text-decoration: none;
    color: #c3f0ca;
    transition: background-color 0.2s ease;
}


.category-dropdown .category-list li a:hover {
    background-color: #333; /* Màu nền khi di chuột */
    color: white; /* Màu chữ khi di chuột (tùy chọn) */
    transform: translateX(2px); /* Hiệu ứng trượt nhẹ sang phải */
}
/* Стиль cho "See all category" */
.category-dropdown .category-list li.see-all a {
    text-align: center;
    font-weight: bold;
    color: white;
    padding: 8px 15px; 
}

.category-dropdown .category-list li.see-all a:hover {
    background-color: #333;
}

</style>
<div class="container">
        
        <div class="sidebar">
        <a href="{{ url('/') }}"><h4 class="module-title booklibrary-title">TRANG CHỦ</h4></a>
                <div class="category-dropdown">
            <h4 class="module-title category-title">Thể loại</h4>
            <ul class="category-list">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('theloai', ['id' => $category->category_id]) }}">
                            {{ $category->category_name }}
                        </a>
                    </li>
                @endforeach
                <li class="see-all">
                    <a href="{{ route('tatca-sach') }}" class="see-all-box">See all book</a>
                </li>
            </ul>

        </div>
       <!--  -->
        <div>
        <h4 class="module-title category-title"><a href="/huong-dan" style="text-decoration: none; color: inherit;">Hướng dẫn</a></h4>

    
        </div>
        <!-- web -->
        <div class="linked-website-dropdown">
        <h4 class="module-title category-title">Web liên kết</h4>
        <ul class="linked-website-list">
        @forelse ($danhSachThuVien as $thuVien)
            <li>
                @if (!empty($thuVien->link_thuvien))
                    <a href="{{ $thuVien->link_thuvien }}" target="_blank" rel="noopener noreferrer">
                        {{ $thuVien->ten_thuvien }}
                    </a>
                @else
                    <span>{{ $thuVien->ten_thuvien }} (Không có link)</span>
                @endif
            </li>
        @empty
            <li>Không có website liên kết.</li>
        @endforelse
    </ul>
</div>
<style>
    /* web liên kết */
    .linked-website-dropdown {
    position: relative; /* Để định vị tuyệt đối cho danh sách */
}

.linked-website-dropdown .linked-website-list {
    display: none; /* Ẩn danh sách ban đầu */
    position: absolute;
    top: 100%; /* Hiển thị ngay dưới tiêu đề */
    left: 0;
    background-color:black; /* Màu nền trang web của bạn */
    border: 1px solid #ccc; /* Viền nhẹ (tùy chọn) */
    border-top: none;
    border-radius: 0 0 8px 8px; /* Bo tròn góc dưới (tùy chọn) */
    z-index: 10;
    width: auto; /* Điều chỉnh độ rộng theo nội dung */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Bóng đổ (tùy chọn) */
    padding: 5px 0;
    list-style-type: none;
    margin: 0;
}

.linked-website-dropdown:hover .linked-website-list {
    display: block; /* Hiển thị danh sách khi hover vào .linked-website-dropdown */
}

.linked-website-dropdown .linked-website-list li a {
    display: block;
    padding: 1px 15px;
    text-decoration: none;
    transition: background-color 0.2s ease;
    color: #c3f0ca;
}

.linked-website-dropdown .linked-website-list li a:hover {
    background-color: #333; /* Màu nền khi di chuột */
    color: white; /* Màu chữ khi di chuột (tùy chọn) */
    transform: translateX(5px); /* Hiệu ứng trượt nhẹ (tùy chọn) */
}

.linked-website-dropdown .linked-website-list li:first-child a {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.linked-website-dropdown .linked-website-list li:last-child a {
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}

.linked-website-dropdown .linked-website-list li span {
    display: block;
    padding: 1px 15px;
    color: #333;
}
</style>
            <div class="readers-list">
                <br><br><br><h5>Người đọc gần đây</h5>
                <ul>
                    @foreach ($recentBorrowers as $borrower)
                        <li class="reader-item">
                            <!-- <img src="{{ asset('images/' . $borrower->photo) }}" alt="{{ $borrower->username }}"> -->
                            <img src="{{ asset('storage/profile/'.$borrower->photo) }}" width="30px" class='mb-1'/>
                            {{ $borrower->username }}   
                        </li>  
                    @endforeach
                   

                </ul>
            </div>
        </div>


        <!-- Nội dung chính -->
        <div class="main-content">
        <div class="header">
            <div class="search-bar">
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" placeholder="Tìm kiếm..." name="search" value="{{ request('search') }}">
                    <button type="submit"> Tìm kiếm</button>
                </form>
            </div>
            
            <div class="header d-flex justify-content-end">
            @auth
                <span class="font-weight-bold">Xin chào ~ {{ Auth::user()->full_name }}</span>
            @endauth
                </div>
        </div>
                

        {{ $slot }}
       </div>

    </div>
        
        <footer>
            <div class='row' style='text-align:center'>
                <div class='col-4'>GIỚI THIỆU</div>
                <div class='col-4'>TRỢ GIÚP</div>
                <div class='col-4' style='text-align:left'>LIÊN HỆ: <br>
                    Số điện thoại: 1800<br>
                    email: nguocdongquakhu@gmail.com</div>
            </div>
        </footer>
         <!-- Bootstrap JS (for dropdown to work) -->
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
</body>
</html>
