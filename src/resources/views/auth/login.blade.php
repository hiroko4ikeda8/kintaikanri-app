@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    <h1>ログイン</h1>

    {{-- フォームの送信先はまだ未設定なので、仮のアクションにしておく --}}
    <form method="GET" action="#">
        {{-- @csrf は POST のときに必要なので、今は省略OK --}}
        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">ログインする</button>
    </form>

    <p style="margin-top: 1rem;">
        <a href="#">会員登録はこちら</a>
    </p>
@endsection
