@extends('admin.master')

@section('main-content')
    <style>
        /* Base Styles */
        /* Tổng thể của trang */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f8;
            /* Nền sáng */
            margin: 0;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            /* Chiều rộng của sidebar */
            background-color: #fff;
            /* Nền trắng */
            padding: 20px;
            /* Padding cho sidebar */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Đổ bóng cho sidebar */
        }

        /* Tiêu đề và menu trong sidebar */
        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Liên kết trong sidebar */
        .sidebar ul {
            list-style-type: none;
            /* Bỏ dấu bullet */
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
            /* Khoảng cách giữa các mục */
        }

        .sidebar ul li a {
            text-decoration: none;
            /* Không gạch chân */
            color: #555;
            /* Màu chữ */
            font-weight: 500;
            /* Đậm chữ */
            transition: color 0.3s;
            /* Hiệu ứng chuyển màu */
        }

        /* Hiện lên khi hover */
        .sidebar ul li a:hover {
            color: #007bff;
            /* Màu khi hover */
        }

        /* Phần chính */
        .main-content {
            flex-grow: 1;
            /* Chiếm toàn bộ không gian còn lại */
            padding: 20px;
            /* Padding cho phần chính */
        }

        /* Tiêu đề chính */
        .main-content h2 {
            color: #333;
            /* Màu tiêu đề */
            margin-bottom: 20px;
            /* Khoảng cách dưới */
        }

        /* Form thêm sách */
        form {
            background-color: #fff;
            /* Nền form */
            border-radius: 5px;
            /* Bo góc cho form */
            padding: 20px;
            /* Padding cho form */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* Đổ bóng cho form */
        }

        /* Nhóm trường trong form */
        .form-group {
            margin-bottom: 15px;
            /* Khoảng cách giữa các nhóm */
        }

        /* Nhãn và input */
        label {
            display: block;
            /* Hiển thị nhãn như khối */
            margin-bottom: 5px;
            /* Khoảng cách dưới nhãn */
            color: #555;
            /* Màu chữ của nhãn */
        }

        input[type="text"],
        input[type="password"],
        input[type="number"],
        select {
            width: 100%;
            /* Rộng 100% */
            padding: 10px;
            /* Padding cho input */
            border: 1px solid #ccc;
            /* Đường viền */
            border-radius: 5px;
            /* Bo góc */
            box-sizing: border-box;
            /* Bao gồm padding và border trong kích thước */
        }

        /* Nút đăng nhập */
        .login-button {
            background-color: #007bff;
            /* Màu nền */
            color: white;
            /* Màu chữ */
            border: none;
            /* Bỏ đường viền */
            border-radius: 5px;
            /* Bo góc */
            padding: 10px;
            /* Padding cho nút */
            cursor: pointer;
            /* Con trỏ chuột khi hover */
            transition: background-color 0.3s;
            /* Hiệu ứng chuyển màu */
        }

        .login-button:hover {
            background-color: #0056b3;
            /* Màu khi hover */
        }

        /* Button Styles */
        .confirm-btn,
        .cancel-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
            margin-right: 10px;
        }

        .confirm-btn {
            background-color: #28a745;
            color: white;
        }

        .confirm-btn:hover {
            background-color: #218838;
        }

        .cancel-btn {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            display: inline-block;
            line-height: 25px;
        }

        .cancel-btn:hover {
            background-color: #5a6268;
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .book-form {
                padding: 15px;
            }
        }
    </style>

    <div class="book-form">
        <h1>Thêm Sách Mới</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="book_title">Tiêu đề sách:</label>
                <input type="text" id="book_title" name="book_title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="author">Tác giả:</label>
                <input type="text" id="author" name="author" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="category_id">Thể loại:</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Chọn thể loại</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="publication_year">Năm xuất bản:</label>
                <input type="number" id="publication_year" name="publication_year" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nha_xuat_ban">Nhà xuất bản:</label>
                <input type="text" id="nha_xuat_ban" name="nha_xuat_ban" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="total_quantity">Tổng số lượng:</label>
                <input type="number" id="total_quantity" name="total_quantity" class="form-control" required min="1">
            </div>
            <div class="form-group">
                <label for="file_anh_bia">Hình ảnh bìa:</label>
                <input type="file" id="file_anh_bia" name="file_anh_bia" class="form-control">
            </div>
            <div class="form-group">
                <label for="mo_ta">Mô tả:</label>
                <textarea id="mo_ta" name="mo_ta" class="form-control" rows="5"></textarea>
            </div>

            <button type="submit" class="confirm-btn">Thêm sách</button>
            <a href="{{ route('admin.qlysach') }}" class="cancel-btn">Quay lại</a>
        </form>
    </div>
@endsection