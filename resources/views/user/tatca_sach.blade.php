<x-user-layout :categories="$categories" :recentBorrowers="$recentBorrowers" :danhSachThuVien="$danhSachThuVien">
    <div class="main-content">
        <h2 class="section-title">Tất cả sách</h2>
        <div class="book-list">
            @foreach ($books as $book)
            <a href="{{ route('book.details', ['id' => $book->book_id]) }}">
                <div class="book-item">
                    <img src="{{ asset('image/' . $book->file_anh_bia) }}" alt="{{ $book->book_title }}">
                    <p>{{ $book->book_title }}</p>
                    <p>{{ $book->nha_xuat_ban }}</p>
                </div>
             </a>
            @endforeach
        </div>
    </div>
</x-user-layout>
