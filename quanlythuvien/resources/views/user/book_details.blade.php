<x-user-layout :categories="$categories" :recentBorrowers="$recentBorrowers" :danhSachThuVien="$danhSachThuVien">
    <div class="main-content">
        <div class="book-detail">
            <h2>{{ $book->book_title }}</h2>
            <img src="{{ asset('image/' . $book->file_anh_bia) }}" alt="{{ $book->book_title }}">
            <p>Tác giả: {{ $book->author }}</p>
            <p>Nhà xuất bản: {{ $book->nha_xuat_ban }}</p>
            <p>Năm xuất bản: {{ $book->publication_year }}</p>
            <p>Mô tả: {{ $book->mo_ta }}</p>
            <p>Số lượng: {{ $book->total_quantity }}</p>
            <p>Số lượng còn lại: {{ $book->available_quantity }}</p>
        </div>
    </div>

    <style>
        .book-detail {
            padding: 20px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .book-detail img {
            max-width: 200px;
            height: auto;
            float: left;
            margin-right: 20px;
        }

        .book-detail h2 {
            margin-top: 0;
        }
    </style>
</x-user-layout>

