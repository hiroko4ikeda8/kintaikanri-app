@extends('layouts.app')

@section('title', 'ユーザー登録')

@if ($errors->any())
    <div class="alert alert-danger">
        入力内容に問題があります。
    </div>
@endif

@section('content')
    <h1>ユーザー登録</h1>

    <form class="form" action="/register" method="post">
        @csrf
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required />
        </div>

        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required />
        </div>

        <div>
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" required />
        </div>

        <div>
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required />
        </div>

        <button type="submit">登録する</button>
    </form>

    <p style="margin-top: 1rem;">
        <a href="{{ route('login') }}">ログインはこちら</a> 
    </p>
    
@endsection
