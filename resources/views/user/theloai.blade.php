<x-user-layout :categories="$categories" :recentBorrowers="$recentBorrowers" :danhSachThuVien="$danhSachThuVien">
    <div class="main-content">
        <h3 class="section-title">Thể loại: {{ $category->category_name }}</h3>

<x-user-layout :categories="$categories" :recentBorrowers="$recentBorrowers">
    <div class="main-content">
        <h2 class="section-title">Sách thuộc thể loại: {{ $category->category_name }}</h2>

        @if ($books->isEmpty())
            <p>Hiện chưa có sách nào thuộc thể loại này.</p>
        @else
            <div class="book-list">
                @foreach ($books as $book)
                    <x-book.card :book="$book" />
                @endforeach
            </div>
        @endif
    </div>
</x-user-layout>
