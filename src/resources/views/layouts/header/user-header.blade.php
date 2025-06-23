<header class="py-3 mb-4 border-bottom bg-dark">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ url('/user/attendance') }}">
            <img src="{{ asset('images/logo.png') }}" alt="勤怠管理アプリ ロゴ" style="height: 50px;">
        </a>
        <nav class="nav">
            <a class="nav-link text-white text-decoration-none me-3" href="{{ route('user.attendance.create') }}">勤怠</a>
            <a class="nav-link text-white text-decoration-none me-3" href="{{ route('user.attendance.list') }}">勤怠一覧</a>
            <a class="nav-link text-white text-decoration-none me-3" href="{{ route('user.stamp_correction_request.list') }}">申請</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline align-self-center">
                @csrf
                <!-- <button type="submit" class="btn btn-link text-white text-decoration-none p-0 m-0 align-baseline"> -->
                <button type="submit" class="btn btn-link text-white text-decoration-none p-0 m-0">
                    ログアウト
                </button>
            </form>
        </nav>
    </div>
</header>
