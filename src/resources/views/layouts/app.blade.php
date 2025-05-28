<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', '勤怠管理アプリ')</title>
    <!-- あとでBootstrap追加 -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <!-- カスタムスタイル（Interフォント適用） -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>
    {{-- 各画面の@section('header') から来る内容をここに表示 --}}
    @yield('header')

    <main class="container mt-4">
        @yield('content')
    </main>

    <footer class="text-center mt-5">
        <p>&copy; 2025 勤怠管理アプリ</p>
    </footer>

    <!-- BootstrapのJSも後で追加可 -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
