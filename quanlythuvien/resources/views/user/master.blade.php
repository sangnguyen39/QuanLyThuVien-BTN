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
            max-width: 1200px;
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
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <a href="{{ url('/') }}"><h2>BOOKLIBRARY</h2></a>

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
                <img src="{{ asset('storage/profile/'.$borrower->photo) }}" width="30px" class='mb-1'/>
                

                {{ $borrower->username }}
            </li>
        @endforeach
        <li><a href="#" class="see-all">See all</a></li>
    </ul>
            </div>
        </div>
        <!-- Main Content -->
        @yield('main-content')
    </div>
    <footer>
            <div class='row' style='text-align:center'>
                <div class='col-4'>TRỤ SỞ</div>
                <div class='col-4'>TRỢ GIÚP</div>
                <div class='col-4'>SDT LIÊN HỆ: 0326064422</div>
            </div>
        </footer>
</body>

</html>