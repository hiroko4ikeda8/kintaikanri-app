@extends('layouts.app')

@section('title', 'ユーザー登録')

@section('header')
    @include('layouts.header.auth-header')
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            会員情報が登録されていません
        </div>
    @endif
    
    <h1>ユーザー登録</h1>

    <form class="form" action="{{ route('register') }}" method="post">
        @csrf
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

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

        <div>
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
            @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">登録する</button>
    </form>

    <p style="margin-top: 1rem;">
        <a href="{{ route('login') }}">ログインはこちら</a> 
    </p>
    
@endsection
