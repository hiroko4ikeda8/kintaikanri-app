@extends('layouts.app')

@section('title', 'ユーザー登録')

@section('content')
    <h1>ユーザー登録</h1>

    {{-- 静的UI表示用：ルート未定なので action="#"、method="GET" --}}
    <form method="GET" action="#">
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <button type="submit">登録する</button>
    </form>

    <p style="margin-top: 1rem;">
        <a href="#">ログインはこちら</a>
    </p>
    
@endsection
