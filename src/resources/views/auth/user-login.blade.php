@extends('layouts.app')

@section('title', 'ログイン')

@if ($errors->any())
    <div class="alert alert-danger">
        ログイン情報が登録されていません
    </div>
@endif

@section('content')
    <h1>ログイン</h1>

        <form class="form" action="{{ route('user.login') }}" method="POST">

        @csrf

        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">ログインする</button>
    </form>

    <p style="margin-top: 1rem;">
        <a href={{ route('register') }}>会員登録はこちら</a>
    </p>
@endsection
