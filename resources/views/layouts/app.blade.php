<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Thư Viện</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @include('partials.header')
        
        <main class="py-4">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>
</body>
</html>
