<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="login-container">
        <div class="logo-section">
            <img src="image/logo.jpg" alt="HUB logo">
        </div>
        <div class="form-section">
            <h2>Đăng ký</h2>
            <form action="{{route('auth.register.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="student_id">Mã sinh viên</label>
                    <input type="text" id="student_id" name="student_id" placeholder="Nhập mã sinh viên" required>
                </div>
                <div class="form-group">
                    <label for="student_id">Họ và tên</label>
                    <input type="text" id="full_name" name="full_name" placeholder="Nhập họ và tên" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Nhập email" required>
                </div>
                <div class="form-group">
                    <label for="class">Lớp</label>
                    <input type="text" id="class" name="class" placeholder="Nhập lớp" required>
                </div>
                <div class="form-group">
                    <label for="course_year">Khóa học</label>
                    <input type="number" id="course_year" name="course_year" placeholder="Nhập khóa học" required>
                </div>
                <div class="form-group">
                    <label for="student_id">Tên đăng nhập</label>
                    <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="register-button">Đăng ký</button>
            </form>
            <br>
            <form action="{{route('auth.login')}}"><button type="submit" class="login-button">Đã có tài khoản</button>
            </form>
        </div>
    </div>
</body>

</html>