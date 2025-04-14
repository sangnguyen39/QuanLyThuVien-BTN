<div class="book-item">
    <a href="{{ route('book.details', ['id' => $book->book_id]) }}">
        <img src="{{ asset('image/' . $book->file_anh_bia) }}" alt="{{ $book->book_title }}">
    
    <p>{{ $book->book_title }}</p>
    <p>{{ $book->nha_xuat_ban }}</p>
    </a>
</div>
