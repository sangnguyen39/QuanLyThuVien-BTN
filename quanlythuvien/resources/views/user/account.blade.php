<style>
    /* Đặt lại các thuộc tính chung để đồng nhất */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Thiết lập nền cho toàn trang */
body {
    background-color: #f0f2f5;
    font-family: 'Arial', sans-serif;
}

/* Thiết lập layout cho panel */
.x-account-panel {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Bố cục form với diện tích lớn hơn */
form {
    background-color: #ffffff;
    padding: 30px; /* Giảm padding */
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    width: 60%; /* Giảm chiều rộng của form */
    margin: 0 auto;
    max-width: 600px; /* Giảm diện tích form */
}

form label {
    display: block;
    font-size: 16px; /* Giảm kích thước font */
    margin-bottom: 8px; /* Giảm khoảng cách dưới label */
    color: #333;
    font-weight: 600;
}

form input[type="text"],
form input[type="file"] {
    width: 100%;
    padding: 10px; /* Giảm padding trong input */
    margin-bottom: 15px; /* Giảm khoảng cách dưới input */
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px; /* Giảm kích thước font trong input */
    color: #555;
    transition: border-color 0.3s ease;
}

form input[type="submit"] {
    background-color: #15c;
    color: white;
    font-size: 18px; /* Giảm kích thước font trong button */
    font-weight: 700;
    padding: 12px; /* Giảm padding trong button */
    width: 100%;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}


/* Hiệu ứng hover cho button */
form input[type="submit"]:hover {
    background-color: #0d9;
}

/* Hiển thị thông báo lỗi */
.error-message {
    color: red;
    width: 100%;
    margin-bottom: 30px;
    font-size: 16px;
}

.error-message ul {
    list-style-type: none;
    padding: 0;
}

/* Hiển thị thông báo thành công */
.alert {
    background-color: #d4edda;
    color: #155724;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
    font-size: 18px;
}

/* Thêm viền cho ảnh đại diện */
form img {
    border-radius: 50%;
    border: 3px solid #15c;
    margin-bottom: 30px;
}

/* Thiết lập khoảng cách giữa các trường thông tin */
form .form-control-sm {
    margin-bottom: 10px;
}

/* Phong cách cho các thông báo lỗi */
.alert.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}

</style>
<x-account-panel>

    @if ($errors->any())
    <div style='color:red;width:30%; margin:0 auto'>
        <div>
            {{ __('Whoops! Something went wrong.') }} <!-- Thông báo chung khi có lỗi -->
        </div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <!-- Form cập nhật thông tin người dùng -->
    <form method='post' action="{{ route('saveinfo') }}" enctype="multipart/form-data" style='width:80%; margin:0 auto'>
        <div style='text-align:center;font-weight:bold;color:#15c;'>CẬP NHẬT THÔNG TIN CÁ NHÂN</div>
        
        @if ($user->photo)
            <img src="{{ asset('profile/'.$user->photo) }}" width="50px" class="mb-1" />
          @endif
        
        <label>Tên</label>
        <input type='text' class='form-control form-control-sm' name='name' value="{{ $user->name }}">
        
        <label>Email</label>
        <input type='text' class='form-control form-control-sm' name='email' value="{{ $user->email }}">
        
        <label>Mã số sinh viên</label>
        <input type='text' class='form-control form-control-sm' name='user_mssv' value="{{ $user->user_mssv }}">
        <label>Lớp</label>
        <input type='text' class='form-control form-control-sm' name='class' value="{{ $user->class }}">
        <label>Khóa</label>
        <input type='text' class='form-control form-control-sm' name='course_year' value="{{ $user->course_year }}">
        
        <!-- Trường ẩn chứa id của người dùng (để biết đang cập nhật người nào) -->
        <input type='hidden' value='{{ $user->member_id }}' name='member_id'>
        
        <label>Ảnh đại diện</label><br>
        <input type="file" name="photo" id="photo" accept="image/*" class="form-control-file">
        
        {{ csrf_field() }}
        
        <div style='text-align:center;'>
            <input type='submit' class='btn btn-primary mt-1' value='Lưu'>
        </div>
    </form>

</x-account-panel>
