@extends('user.master')

@section('main-content')
    <div class="main-content">
        <h2>Kết quả tìm kiếm cho "{{ $searchTerm }}"</h2>

        @if ($books->count() > 0)
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
        @else
            <p>Không tìm thấy sách nào.</p>
        @endif
    </div>
@endsection