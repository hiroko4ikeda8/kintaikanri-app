@extends('layouts.app')

@section('title', '勤怠一覧画面')

@section('header')
    @include('layouts.header.user-header')
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold">勤怠一覧</h1>

    <!-- 月切り替えコンテナ -->
    <div class="d-flex align-items-center justify-content-center my-3">
        <a href="#" class="btn btn-outline-dark">&larr; 前月</a>
        <span class="mx-3 fw-bold">
            <i class="bi bi-calendar"></i> 2023/06
        </span>
        <a href="#" class="btn btn-outline-dark">翌月 &rarr;</a>
    </div>

    <!-- 勤怠一覧テーブル -->
    <table class="table table-bordered text-center">
        <thead class="table-dark text-white">
            <tr>
                <th>名前</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩</th>
                <th>合計</th>
                <th>詳細</th>
            </tr>
        </thead>
        <body>
            <tr>
                <td>山田　太郎</td>
                <td>09:00</td>
                <td>18:00</td>
                <td>1:00</td>
                <td>8:00</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
            <tr>
                <td>西　怜奈</td>
                <td>09:00</td>
                <td>18:00</td>
                <td>1:00</td>
                <td>8:00</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
            <tr>
                <td>増田　一世</td>
                <td>09:00</td>
                <td>18:00</td>
                <td>1:00</td>
                <td>8:00</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
            <tr>
                <td>山本　敬吉</td>
                <td>09:00</td>
                <td>18:00</td>
                <td>1:00</td>
                <td>8:00</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
            <tr>
                <td>秋田　朋美</td>
                <td>09:00</td>
                <td>18:00</td>
                <td>1:00</td>
                <td>8:00</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
            <tr>
                <td>中西　教夫</td>
                <td>09:00</td>
                <td>18:00</td>
                <td>1:00</td>
                <td>8:00</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
        </body>
    </table>
</div>
@endsection