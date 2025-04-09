<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <img src="image/logo.jpg" alt="HUB Logo">
        </div>
        <div class="form-section">
            <h2>Đăng nhập</h2>
            <form action="{{route('auth.login')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Tên tài khoản</label>
                    <input type="text" id="username" name="username" placeholder="Nhập tên tài khoản" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="form-group remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ghi nhớ đăng nhập lần sau</label>
                </div>
                <button type="submit" class="login-button">Đăng nhập</button> <br> <br> 

            </form>
            <form action="{{route('auth.register')}}"><button type="submit" class="login-button"  style="background-color: rgb(247, 55, 55);">Đăng ký</button></form>
            <br><br>
            <a href="/" style="color:black;">Truy cập thư viện</a><br>

        </div>
    </div>
</body>
</html>
