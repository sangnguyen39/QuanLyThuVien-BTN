<style>
    * {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
}

.main-content {
    max-width: 1100px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
}

:root {
  --primary-color: #3f51b5;
  --secondary-color: #ff6e40;
  --favorite-bg: linear-gradient(135deg, #e8f5e9, #c8e6c9);
  --text-primary: #37474f;
  --text-secondary: #546e7a;
  --accent: #ff4081;
  --shadow-sm: 0 2px 8px rgba(0,0,0,0.1);
  --shadow-md: 0 5px 15px rgba(0,0,0,0.12);
  --shadow-lg: 0 8px 20px rgba(0,0,0,0.15);
  --border-radius: 12px;
  --transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.section-title {
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--primary-color);
  margin: 2.5rem 0 1.5rem;
  padding-bottom: 0.75rem;
  position: relative;
  letter-spacing: 0.5px;
}

.section-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 80px;
  height: 3px;
  background: var(--accent);
  border-radius: 3px;
}

/* Đảm bảo hiển thị đúng 5 cột */
.book-list {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 5px;
  margin-bottom: 3rem;
}

/* Định dạng thẻ sách */
.book-item {
  background: white;
  border-radius: var(--border-radius);
  box-shadow: var(--shadow-sm);
  overflow: hidden;
  transition: var(--transition);
  height: 320px;
  display: flex;
  flex-direction: column;
  position: relative;
  border: none;
  animation: fadeInUp 0.6s ease forwards;
  opacity: 0;
}

/* Nền cho từng phần */
.section-title:first-of-type + .book-list .book-item {
  background: var(--favorite-bg);
}

.section-title:last-of-type + .book-list .book-item {
  background: #f0f0f0; /* xám nhạt */
}

/* Bỏ chữ "Mới" */
.section-title:last-of-type + .book-list .book-item::before {
  content: '';
  display: none;
}

.book-item:hover {
  transform: translateY(-8px) scale(1.02);
  box-shadow: var(--shadow-lg);
}

.book-img-container {
  height: 200px;
  overflow: hidden;
  position: relative;
  border-radius: var(--border-radius) var(--border-radius) 0 0;
}

.book-item img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  transition: var(--transition);
  transform-origin: center;
}

.book-item:hover img {
  transform: scale(1.08);
}

.book-img-container::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, rgba(0,0,0,0) 60%, rgba(0,0,0,0.5));
  opacity: 0;
  transition: var(--transition);
}

.book-item:hover .book-img-container::after {
  opacity: 1;
}

.book-content {
  padding: 15px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
  justify-content: space-between;
}

.book-title {
  font-weight: 600;
  font-size: 15px;
  color: var(--text-primary);
  margin: 0 0 8px;
  line-height: 1.4;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  max-height: 42px;
}

.book-item:hover .book-title {
  color: var(--primary-color);
}

.book-publisher {
  color: var(--text-secondary);
  font-size: 12px;
  font-style: italic;
  margin-top: auto;
  padding-top: 10px;
  border-top: 1px solid rgba(0,0,0,0.08);
}

/* Badge "Hot" cho sách yêu thích */
.section-title:first-of-type + .book-list .book-item::before {
  content: 'Hot';
  position: absolute;
  top: 10px;
  right: 10px;
  background: var(--accent);
  color: white;
  padding: 5px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: bold;
  z-index: 2;
  box-shadow: 0 2px 5px rgba(255, 64, 129, 0.3);
}

/* Animation fadeIn */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.book-list:first-of-type .book-item:nth-child(1) { animation-delay: 0.1s; }
.book-list:first-of-type .book-item:nth-child(2) { animation-delay: 0.2s; }
.book-list:first-of-type .book-item:nth-child(3) { animation-delay: 0.3s; }
.book-list:first-of-type .book-item:nth-child(4) { animation-delay: 0.4s; }
.book-list:first-of-type .book-item:nth-child(5) { animation-delay: 0.5s; }

.book-list:last-of-type .book-item:nth-child(1) { animation-delay: 0.6s; }
.book-list:last-of-type .book-item:nth-child(2) { animation-delay: 0.7s; }
.book-list:last-of-type .book-item:nth-child(3) { animation-delay: 0.8s; }
.book-list:last-of-type .book-item:nth-child(4) { animation-delay: 0.9s; }
.book-list:last-of-type .book-item:nth-child(5) { animation-delay: 1s; }

/* Shine hover effect */
.book-img-container::before {
  content: '';
  position: absolute;
  top: 0;
  left: -75%;
  z-index: 2;
  width: 50%;
  height: 100%;
  background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 100%);
  transform: skewX(-25deg);
  transition: all 0.75s;
}

.book-item:hover .book-img-container::before {
  animation: shine 0.85s;
}

@keyframes shine {
  100% {
    left: 125%;
  }
}

.book-item::after {
  content: 'Xem chi tiết';
  position: absolute;
  bottom: -40px;
  left: 50%;
  transform: translateX(-50%);
  background: var(--primary-color);
  color: white;
  padding: 7px 15px;
  border-radius: 20px;
  font-size: 12px;
  transition: var(--transition);
  opacity: 0;
  z-index: 3;
}

.book-item:hover::after {
  bottom: 15px;
  opacity: 1;
}

/* Responsive */
@media screen and (max-width: 768px) {
  .book-list {
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 15px;
  }

  .book-item {
    height: 280px;
  }

  .book-img-container {
    height: 170px;
  }

  .book-item img {
    height: 170px;
  }

  .book-content {
    padding: 10px;
  }

  .book-title {
    font-size: 13px;
    -webkit-line-clamp: 2;
    max-height: 36px;
  }
}

.book-item a {
  text-decoration: none;
  color: inherit;
  display: flex;
  flex-direction: column;
  height: 100%;
}
/* Thêm hiệu ứng khi hover vào thẻ sách */
.book-item:hover p {
    color:blue; /* Đổi màu chữ khi hover vào thẻ sách */
}
footer {
            background-color: #333;
            color: white;
            padding: 30px;
            margin-top: 40px;
            font-size: 25px; /* Phóng to chữ cho footer */
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;  /* Cho phép các phần tử trong footer xếp chồng khi màn hình nhỏ */
        }

        .footer-item {
            width: 30%;
            text-align: center;
            margin-bottom: 20px;
        }

        .footer-item h4 {
            font-size: 20px;
            color: #fff;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-item p {
            font-size: 18px;
            color: #ccc;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                align-items: center;
            }

            .footer-item {
                width: 100%;
            }
        }
</style>
<x-user-layout :categories="$categories" :recentBorrowers="$recentBorrowers">
    <div class="main-content">
        <div class="header">
            <div class="search-bar">
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" placeholder="Tìm kiếm..." name="search" value="{{ request('search') }}">
                    <button type="submit">Tìm</button>
                </form>
            </div>
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
