<header class="header py-3 mb-4 border-bottom bg-dark">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="勤怠管理アプリ ロゴ" style="height: 50px;">
        </a>
        <nav>
            <a class="text-white text-decoration-none me-3" href="{{ route('admin.attendance.list') }}">勤怠一覧</a>
            <a class="text-white text-decoration-none me-3" href="{{ route('admin.staff.index') }}">スタッフ一覧</a>
            <a class="text-white text-decoration-none me-3" href="{{ route('admin.stamp_correction_request.list') }}">申請一覧</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link text-white text-decoration-none p-0 m-0 align-baseline">
                    ログアウト
                </button>
            </form>
        </nav>
    </div>
</header>