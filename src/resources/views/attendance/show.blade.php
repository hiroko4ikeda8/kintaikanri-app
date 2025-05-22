@extends('layouts.app')

@section('title', '勤怠詳細画面')

@section('header')
    @include('layouts.header.user-header')
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold">勤怠詳細</h1>

    @section('content')
<div class="container mt-4">
    <h1 class="fw-bold">勤怠詳細</h1>

    <!-- 勤怠詳細コンテナ -->
    <div class="container mt-4">
        <div class="row">
            <!-- 縦型テーブル -->
            <div class="col-md-4">
                <table class="table table-bordered">
                    <tbody class="fw-bold">
                        <tr><td>名前</td></tr>
                        <tr><td>日付</td></tr>
                        <tr><td>出勤・退勤</td></tr>
                        <tr><td>休憩</td></tr>
                        <tr><td>休憩2</td></tr>
                        <tr><td>備考</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- データ表示部分 -->
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tbody>
                        <tr><td>西 怜奈</td></tr>
                        <tr><td>2023年 6月1日</td></tr>
                        <tr><td>09:00 ～ 18:00</td></tr>
                        <tr><td>12:00 ～ 13:00</td></tr>
                        <tr><td>空欄</td></tr>
                        <tr><td>電車遅延のため</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 修正ボタン -->
    <div class="text-center mt-4">
        <button class="btn btn-dark px-5 py-2">修正</button>
    </div>
</div>
@endsection

    <!-- 修正ボタン -->
    <div class="text-center mt-4">
        <button class="btn btn-dark px-5 py-2">修正</button>
    </div>
</div>
@endsection