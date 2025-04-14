@extends('admin.master')
@section('main-content')

<div class="main-content">
    <h1>Quản lý phiếu mượn</h1>

    {{-- Debug xem có dữ liệu chưa --}}
    {{-- <pre>{{ print_r($data, true) }}</pre> --}}

    <div class="tabs">
        <button class="tab {{ $status == 'all' ? 'active' : '' }}" 
            onclick="window.location.href='{{ route('admin.qlphieumuon', ['status' => 'all']) }}'">
            Tất cả
        </button>
        <button class="tab {{ $status == 'borrowed' ? 'active' : '' }}" 
            onclick="window.location.href='{{ route('admin.qlphieumuon', ['status' => 'borrowed']) }}'">
            Đang mượn
        </button>
        <button class="tab {{ $status == 'returned' ? 'active' : '' }}" 
            onclick="window.location.href='{{ route('admin.qlphieumuon', ['status' => 'returned']) }}'">
            Đã trả
        </button>
        <button class="tab {{ $status == 'overdue' ? 'active' : '' }}" 
            onclick="window.location.href='{{ route('admin.qlphieumuon', ['status' => 'overdue']) }}'">
            Quá hạn
        </button>
    </div>

    <form method="GET" action="{{ route('admin.qlphieumuon') }}" id="searchForm">
        <div class="input-group mb-3" style="max-width: 400px;">
            <input type="text"
                   class="search-book"
                   name="keyword"
                   style="border-radius:4px"
                   placeholder="Tìm theo mã sinh viên"
                   value="{{ request('keyword') }}"
                   oninput="delayedSubmit()">
        </div>
    </form>

    <table style="width: 100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Mã sinh viên</th>
                <th>Ngày mượn</th>
                <th>Ngày trả</th>
                <th>Hạn trả</th>
                <th>Mã sách</th>
                <th>Chấp nhận/Từ chối</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
            <tr>
                <td>{{ $data->firstItem() + $index }}</td>
                <td>{{ $item->member->full_name ?? 'Không rõ' }}</td>
                <td>{{ $item->member->student_id ?? 'Không rõ' }}</td>
                <td>{{ $item->borrow_date }}</td>
                <td>{{ $item->due_date }}</td>
                <td>{{ $item->return_date }}</td>
                <td>{{ $item->borrow_id }}</td>
                <td>
                    @if ($item->status_book === 'returned')
                        <span style="color: green;">Đã trả</span>
                    @else
                        <span style="color: red;">Chưa trả</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $data->links() }}
    </div>
</div>
<script>
    let typingTimer;
    function delayedSubmit() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 600); // Chờ 600ms sau khi gõ xong mới gửi
    }
</script>
@endsection
