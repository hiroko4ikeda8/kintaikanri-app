<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', '勤怠管理アプリ')</title>
    <!-- あとでBootstrap追加 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <!-- カスタムスタイル（Interフォント適用） -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex align-items-center">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="勤怠管理アプリ ロゴ" style="height: 50px;">
            </a>
        </div>
    </header>

    <main class="container mt-4">
        @yield('content')
    </main>

    <footer class="text-center mt-5">
        <p>&copy; 2025 勤怠管理アプリ</p>
    </footer>

    <!-- BootstrapのJSも後で追加可 -->
</body>
</html>
