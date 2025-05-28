<header class="py-3 mb-4 border-bottom bg-dark">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="勤怠管理アプリ ロゴ" style="height: 50px;">
        </a>
        <nav>
            <a class="text-white me-3" href="{{ route('user.attendance.create') }}">勤怠</a>
            <a class="text-white me-3" href="{{ route('user.attendance.list') }}">勤怠一覧</a>
            <a class="text-white me-3" href="#">申請</a>
            <a class="text-white" href="#">ログアウト</a>
        </nav>
    </div>
</header>