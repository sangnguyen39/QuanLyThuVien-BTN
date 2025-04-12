@extends('layouts.borrow-management')
@section('content')

<main class="main-content">
    <h1>Quản lý member </h1>

    <form method="GET" action="{{ route('admin.qlmember') }}" id="searchForm">
        <div class="input-group mb-3" style="max-width: 400px;">
            <input type="text"
                   name="keyword"
                   class="form-control"
                   placeholder="Tìm kiếm theo mã sinh viên..."
                   value="{{ request('keyword') }}"
                   oninput="delayedSubmit()">
        </div>
    </form>

<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Họ và tên</th>
            <th>Mã sinh viên</th>
            <th>Email</th>
            <th>Lớp </th>
            <th>Khóa học</th>
            <th style="text-align: center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $item)
            <tr>
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    <td>{{ $item->full_name ?? 'Không rõ' }}</td>
                    <td>{{ $item->student_id ?? 'Không rõ' }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->class }}</td>
                    <td>{{ $item->course_year }}</td>
                    <td style="text-align: center">
                        
                        <form action="{{ route('admin.member.destroy', $item->member_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            <button style="width: 100px" type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-4">
    {{ $data->links() }}
</div>
</main>
<script>
    let typingTimer;
    function delayedSubmit() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 600);
    }
</script>    
@endsection
