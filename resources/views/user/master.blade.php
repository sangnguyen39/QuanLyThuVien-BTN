<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKLIBRARY</title>
    
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
            padding: 8px 0;
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
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .book-item {
            text-align: center;
        }

.book-item img {
    width: 100%;
    height: 240px;
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
    


    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h2>BOOKLIBRARY</h2>
            <h3>Thể loại</h3>
            <ul>
                <li><a href="#">Văn học</a></li>
                <li><a href="#">Khoa học và công nghệ</a></li>
                <li><a href="#">Khoa học xã hội và nhân văn</a></li>
                <li><a href="#">Giáo dục</a></li>
                <li><a href="#">Kinh tế kinh doanh</a></li>
                <li><a href="#">Nghệ thuật và thiết kế</a></li>
                <li><a href="#">Kỹ thuật và công nghệ thông tin</a></li>
                <li><a href="#">Ngoại ngữ và Ngôn ngữ học</a></li>
                <li><a href="#">Nông nghiệp và môi trường</a></li>
                <li><a href="#">Y học và chăm sóc sức khỏe</a></li>
                <li><a href="#" class="see-all">See all</a></li>
            </ul>

            <div class="readers-list">
                <h3>Người đọc gần đây</h3>
                <ul>
                    <li class="reader-item"><img src="https://via.placeholder.com/30/007bff/FFFFFF?Text=PS"
                            alt="Phú Sang"> Phú Sang</li>
                    <li class="reader-item"><img src="https://via.placeholder.com/30/28a745/FFFFFF?Text=TT"
                            alt="Thu Thảo"> Thu Thảo</li>
                    <li class="reader-item"><img src="https://via.placeholder.com/30/dc3545/FFFFFF?Text=XV"
                            alt="Xuân Vũ"> Xuân Vũ</li>
                    <li class="reader-item"><img src="https://via.placeholder.com/30/ffc107/000000?Text=HĐ"
                            alt="Hoài Duyên"> Hoài Duyên</li>
                    <li class="reader-item"><img src="https://via.placeholder.com/30/17a2b8/FFFFFF?Text=MU"
                            alt="Mỹ Uyên"> Mỹ Uyên</li>
                    <li><a href="#" class="see-all">See all</a></li>
                </ul>
            </div>
        </div>
        <!-- Main Content -->
        @yield('main-content')
    </div>
</body>

</html>