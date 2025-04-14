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
                margin-bottom: 0px;
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
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
        }
        /* Phần Sidebar */
.sidebar {
    width: 280px;
    background-color: #ffffff; /* Màu nền trắng sạch sẽ */
    padding: 20px; /* Giảm padding để thu hẹp khoảng cách */
    border-radius: 20px;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12); /* Bóng nhẹ xung quanh */
    position: sticky;
    top: 20px;
    transition: all 0.3s ease;
}

/* Tiêu đề Sidebar */
.sidebar h3 {
    color: #003366; /* Màu xanh đậm dễ nhìn */
    font-size: 1.7rem;
    margin-bottom: 0px; /* Giảm margin dưới tiêu đề */
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Danh sách thể loại */
.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* Mỗi item trong menu */
.sidebar li {
    padding: 0px ; /* Giảm padding trên và dưới */
    margin-bottom: 8px; /* Giảm margin dưới mỗi item */
}

/* Liên kết trong sidebar */
.sidebar li a {
    text-decoration: none;
    color: #555;
    display: block;
    font-size: 1.3rem;
    padding: 12px 18px; /* Giảm padding cho các liên kết */
    border-radius: 8px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Hiệu ứng hover */
.sidebar li a:hover {
    background-color: #f0f8ff;
    color: #007bff;
    padding-left: 22px;
}

/* "See all" Link */
.sidebar .see-all {
    color: #007bff;
    font-size: 1.2rem;
    text-align: right;
    display: block;
    margin-top: 18px; /* Giảm khoảng cách trên */
    font-weight: 600;
    transition: color 0.3s ease;
}

.sidebar .see-all:hover {
    color: #0056b3;
}

/* Section người đọc gần đây */
.readers-list {
    margin-top: 30px;
}

/* Tiêu đề phần người đọc gần đây */
.readers-list h3 {
    font-size: 1.5rem;
    color: #003366;
    margin-bottom: 15px; /* Giảm khoảng cách dưới tiêu đề */
    font-weight: 600;
}

/* Danh sách người đọc gần đây */
.readers-list ul {
    list-style: none;
    padding: 0;
}

.reader-item {
    display: flex;
    align-items: center;
    padding: 10px 0; /* Giảm padding cho phần người đọc */
    transition: transform 0.3s ease, background-color 0.3s ease;
    border-radius: 10px;
    background-color: #ffffff;
}

/* Ảnh đại diện người đọc */
.reader-item img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 12px; /* Giảm khoảng cách giữa ảnh và tên */
    object-fit: cover;
}

/* Hiệu ứng hover cho người đọc */
.reader-item:hover {
    transform: scale(1.05);
    background-color: #f9f9f9;
}

/* Cải tiến giao diện cho màn hình nhỏ */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        padding: 18px; /* Giảm padding cho sidebar */
        margin-bottom: 15px; /* Giảm margin dưới sidebar */
        box-shadow: none;
    }

    .sidebar h3 {
        font-size: 1.5rem;
        margin-bottom: 10px; /* Giảm khoảng cách dưới tiêu đề */
    }

    .sidebar li a {
        font-size: 1.1rem;
        padding: 10px 15px;
    }

    .readers-list h3 {
        font-size: 1.4rem;
        margin-bottom: 0px;
    }
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
            padding: 8px;
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
            /* display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 30px; */
            display:grid;
            grid-template-columns:repeat(5,20%);
        }

        .book-item {
            text-align: center;
            margin:10px;
        
        }

        .book-item img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.05);
        }

        .book-item p {
            margin-top: 5px;
            font-size: 0.9em;
            color: #555;
        }

        .see-all {
            color: #007bff;
            cursor: pointer;
            display: block;
            margin-top: 10px;
        }

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
        background-color: rgb(115, 80, 255);
        max-width: 1200px;
        font-weight: bold;
        margin: 0 auto;
    }

    .nav-item a {
        color: #fff !important;
    }

    .list-book {
        display: grid;
        grid-template-columns: repeat(5, 20%);
    }

    .book {
        margin: 10px;
        text-align: center;
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
       
    }
    

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
                            {{ Auth::user()->name }}
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
                    <a href="{{ route('login') }}">
                        <button class="btn btn-sm btn-primary">Đăng nhập</button>
                    </a>
                    <a href="{{ route('register') }}">
                        <button class="btn btn-sm btn-success">Đăng ký</button>
                    </a>
                @endauth
            </div>
        </div>
    </nav>
</header>


    
    <div class="container">
        
        <div class="sidebar">
        <a href="{{ url('/') }}"><h3>BOOKLIBRARY</h3></a>
        <h3>Thể loại</h3>
            <ul>
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('theloai', ['id' => $category->category_id]) }}">
                            {{ $category->category_name }}
                        </a>
                    </li>
                @endforeach
                <li><a href="{{ route('tatca-sach') }}" class="see-all">See all</a></li>
            </ul>

            <div class="readers-list">
                <h3>Người đọc gần đây</h3>
                <ul>
                    @foreach ($recentBorrowers as $borrower)
                        <li class="reader-item">
                            <img src="{{ asset('images/' . $borrower->photo) }}" alt="{{ $borrower->name }}">
                            {{ $borrower->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Nội dung chính -->
        {{ $slot }}
    </div>
        
        <footer>
            <div class='row' style='text-align:center'>
                <div class='col-4'>TRỤ SỞ</div>
                <div class='col-4'>TRỢ GIÚP</div>
                <div class='col-4'>SDT LIÊN HỆ: 0326064422</div>
            </div>
        </footer>
         <!-- Bootstrap JS (for dropdown to work) -->
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
</body>
</html>
