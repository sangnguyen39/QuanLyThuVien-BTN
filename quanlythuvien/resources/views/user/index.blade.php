<x-user-layout :categories="$categories" :recentBorrowers="$recentBorrowers">
    <div class="main-content">
        <div class="header">
            <div class="search-bar">
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" placeholder="Tìm kiếm..." name="search" value="{{ request('search') }}">
                    <button type="submit">Tìm kiếm</button>
                </form>
            </div>
            <!-- <div class="user-info">
                <span>Xin chào: Trần Xuân Vũ</span>
                <button>Đăng xuất</button>
            </div> -->
        </div>

        <section>
            <h2 class="section-title">Sách yêu thích nhất</h2>
            <div class="book-list">
                
                @foreach ($popularBooks as $book)
                <a href="{{ route('book.details', ['id' => $book->book_id]) }}">

                    <div class="book-item">
                        <img src="{{ asset('image/' . $book->file_anh_bia) }}" alt="{{ $book->book_title }}">
                        <p>{{ $book->book_title }}</p>
                        <p>{{ $book->nha_xuat_ban }}</p>
                    </div>
</a>
                @endforeach
            </div>
        </section>

        <section>
            <h2 class="section-title">Sách mới thêm gần đây</h2>
            <div class="book-list">
                @foreach ($newlyAddedBooks as $book)
                <a href="{{ route('book.details', ['id' => $book->book_id]) }}">

                    <div class="book-item">
                        <img src="{{ asset('image/' . $book->file_anh_bia) }}" alt="{{ $book->book_title }}">
                        <p>{{ $book->book_title }}</p>
                        <p>{{ $book->nha_xuat_ban }}</p>
                    </div>
</a>
                @endforeach
            </div>
        </section>
    </div>
</x-user-layout>
