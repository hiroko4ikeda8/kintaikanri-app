@extends('layouts.app')

@section('title', '申請一覧画面（一般ユーザー）')

@section('header')
    @include('layouts.header.user-header')
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold">| 申請一覧</h1>

    <!-- 承認待ち・承認済みテキスト -->
    <div class="d-flex justify-content-around my-3">
        <span class="fw-bold fs-5">承認待ち</span>
        <span class="fw-bold fs-5">承認済み</span>
    </div>

    <!-- ボーダー -->
    <hr class="border-dark">

    <!-- 申請一覧テーブル -->
    <table class="table table-bordered text-center">
        <thead class="table-dark text-white">
            <tr>
                <th>状態</th>
                <th>名前</th>
                <th>対象日時</th>
                <th>申請理由</th>
                <th>申請日時</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 9; $i++)
            <tr>
                <td>承認待ち</td>
                <td>西 怜奈</td>
                <td>2023/08/01</td>
                <td>遅延のため</td>
                <td>2023/06/02</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>
@endsection