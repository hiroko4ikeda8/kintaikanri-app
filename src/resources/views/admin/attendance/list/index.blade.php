
@extends('layouts.app')

@section('title', '勤怠一覧画面')

@section('header')
    @include('layouts.header.admin-header')
@endsection

@section('content')
<div class="container mt-4">
    <div class="text-center">
        <h2 class="fw-bold mb-4">管理者ダッシュボード</h2>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card bg-light p-4">
                <h5 class="fw-bold">ユーザー管理</h5>
                <p>登録ユーザーの一覧を確認し、管理できます。</p>
                <a href="#" class="btn btn-dark">ユーザー一覧</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-light p-4">
                <h5 class="fw-bold">勤怠管理</h5>
                <p>全ユーザーの勤怠記録を確認できます。</p>
                <a href="#" class="btn btn-dark">勤怠一覧</a>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card bg-light p-4">
                <h5 class="fw-bold">申請承認</h5>
                <p>休暇や残業申請の承認ができます。</p>
                <a href="#" class="btn btn-dark">申請一覧</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-light p-4">
                <h5 class="fw-bold">システム設定</h5>
                <p>各種設定の管理を行います。</p>
                <a href="#" class="btn btn-dark">設定画面</a>
            </div>
        </div>
    </div>
</div>
@endsection