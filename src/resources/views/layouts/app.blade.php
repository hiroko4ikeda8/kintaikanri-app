<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', '勤怠管理アプリ')</title>
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @if(Auth::check() && Auth::user()->role === 'admin')
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    @endif

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <!-- カスタムスタイル（Interフォント適用） -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            font-weight: 600; /* ここでフォントの太さを指定 */
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

    {{-- 各画面固有のスクリプトをここで挿入 --}}
    @yield('scripts')
    <!-- Bootstrap の JavaScript を追加 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
