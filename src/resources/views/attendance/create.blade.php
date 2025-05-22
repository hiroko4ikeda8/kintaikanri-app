@extends('layouts.app')

@section('title', '勤務登録画面')

@section('header')
    @include('layouts.header.user-header')
@endsection

@section('content')
<div class="text-center mt-5">
    <h2 class="fw-bold">2023年6月1日(木)</h2>
    <h1 class="fw-bold display-4">08:00</h1>
    <button class="btn btn-dark mt-4 px-5 py-2">出勤</button>
</div>
@endsection