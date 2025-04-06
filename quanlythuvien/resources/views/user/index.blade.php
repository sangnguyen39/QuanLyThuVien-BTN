@extends('user.master')
        <!-- Main Content -->
@section('main-content')
<div class="main-content">
    <div class="header">
        <div class="search-bar">
            <input type="text" placeholder="Tìm kiếm...">
        </div>
        <div class="user-info">
            <span>Xin chào: Trần Xuân Vũ</span>
            <button>Đăng xuất</button>
        </div>
    </div>

    <section>
        <h2 class="section-title">Sách yêu thích nhất</h2>
        <div class="book-list">
            <div class="book-item">
                <img src="https://m.media-amazon.com/images/I/71jlbVtM-ZL._AC_UF1000,1000_QL80_.jpg"
                    alt="The Wonderful Wizard of Oz">
                <p>The Wonderful Wizard of Oz</p>
            </div>
            <div class="book-item">
                <img src="https://m.media-amazon.com/images/I/71sF8vXv-GL._AC_UF1000,1000_QL80_.jpg"
                    alt="Rise Above Wilderness">
                <p>Rise Above Wilderness</p>
            </div>
            <div class="book-item">
                <img src="https://m.media-amazon.com/images/I/71yzjoG8GEL._AC_UF1000,1000_QL80_.jpg"
                    alt="Parallel Universes">
                <p>Parallel Universes</p>
            </div>
            <div class="book-item">
                <img src="https://m.media-amazon.com/images/I/71s491wrglL._AC_UF1000,1000_QL80_.jpg"
                    alt="A Year of Positive Thinking">
                <p>A Year of Positive Thinking</p>
            </div>
            <div class="book-item">
                <img src="https://m.media-amazon.com/images/I/71k64tT-q5L._AC_UF1000,1000_QL80_.jpg"
                    alt="Brave New World">
                <p>Brave New World</p>
            </div>
        </div>
    </section>

    <section>
        <h2 class="section-title">Sách mới cập nhật</h2>
        <div class="book-list">
            <div class="book-item">
                <img src="https://m.media-amazon.com/images/I/51j3z2mK6jL._AC_UF1000,1000_QL80_.jpg"
                    alt="The Lost Pirates">
                <p>The Lost Pirates</p>
            </div>
            <div class="book-item">
                <img src="https://m.media-amazon.com/images/I/810k7sXkHRL._AC_UF1000,1000_QL80_.jpg"
                    alt="The Paladin">
                <p>The Paladin</p>
            </div>
            <div class="book-item">
                <img src="https://m.media-amazon.com/images/I/714jKi-tFmL._AC_UF1000,1000_QL80_.jpg"
                    alt="The Imperfections of Memory">
                <p>The Imperfections of Memory</p>
            </div>
            <div class="book-item">
                <img src="https://m.media-amazon.com/images/I/71c14L09JCL._AC_UF1000,1000_QL80_.jpg"
                    alt="Tree of Knowledge">
                <p>Tree of Knowledge</p>
            </div>
            <div class="book-item">
                <img src="https://m.media-amazon.com/images/I/619n4n2-xFL._AC_UF1000,1000_QL80_.jpg"
                    alt="Stop Thinking Just Do">
                <p>Stop Thinking Just Do</p>
            </div>
        </div>
    </section>
</div>
@endsection
    