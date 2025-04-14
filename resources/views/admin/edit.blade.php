@extends('admin.master')

@section('main-content')
    <style>
        /* Base Styles */
        .book-form {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }
        
        .book-form h1 {
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: 600;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .form-control:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        
        select.form-control {
            height: 40px;
        }
        
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        
        /* Image Preview */
        .form-group img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            background: white;
        }
        
        /* Button Styles */
        .update-btn, .cancel-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
            margin-right: 10px;
        }
        
        .update-btn {
            background-color: #17a2b8;
            color: white;
        }
        
        .update-btn:hover {
            background-color: #138496;
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
        <h1>Cập nhật thông tin sách</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.update', $book->book_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="book_title">Tiêu đề sách:</label>
                <input type="text" id="book_title" name="book_title" class="form-control" value="{{ $book->book_title }}" required>
            </div>
            <div class="form-group">
                <label for="author">Tác giả:</label>
                <input type="text" id="author" name="author" class="form-control" value="{{ $book->author }}" required>
            </div>
            <div class="form-group">
                <label for="category_id">Thể loại:</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Chọn thể loại</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}" {{ $book->category_id == $category->category_id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="publication_year">Năm xuất bản:</label>
                <input type="number" id="publication_year" name="publication_year" class="form-control" value="{{ $book->publication_year }}" required>
            </div>
            <div class="form-group">
                <label for="nha_xuat_ban">Nhà xuất bản:</label>
                <input type="text" id="nha_xuat_ban" name="nha_xuat_ban" class="form-control" value="{{ $book->nha_xuat_ban }}" required>
            </div>
            <div class="form-group">
                <label for="total_quantity">Tổng số lượng:</label>
                <input type="number" id="total_quantity" name="total_quantity" class="form-control" value="{{ $book->total_quantity }}" required min="1">
            </div>
            <div class="form-group">
                <label for="file_anh_bia">Hình ảnh bìa:</label>
                <input type="file" id="file_anh_bia" name="file_anh_bia" class="form-control">
                @if($book->file_anh_bia)
                    <img src="{{ asset('storage/' . $book->file_anh_bia) }}" width="100" class="mt-2">
                @endif
            </div>
            <div class="form-group">
                <label for="mo_ta">Mô tả:</label>
                <textarea id="mo_ta" name="mo_ta" class="form-control" rows="5">{{ $book->mo_ta }}</textarea>
            </div>

            <button type="submit" class="update-btn">Cập nhật</button>
            <a href="{{ route('admin.qlysach') }}" class="cancel-btn">Quay lại</a>
        </form>
    </div>
@endsection
