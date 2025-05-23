@extends('layouts.app')

@section('title', '管理者ログイン(管理者)')

@section('header')
    @include('layouts.header.admin-header')
@endsection



@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            ログイン情報が登録されていません
        </div>
    @endif
    
    <h1>管理者ログイン</h1>

        <form class="form" action="{{ route('admin.login') }}" method="POST">

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

        <button type="submit">管理者ログインする</button>
    </form>
@endsection
