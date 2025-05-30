@extends('layouts.app')

@section('title', '勤務登録画面（一般ユーザー）')

@section('header')
    @include('layouts.header.user-header')
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="text-center">
        <span id="status-label" class="d-inline-block px-3 py-1 rounded-pill fw-bold mb-4"
              style="background-color: #C8C8C8; color: #696969;">
            勤 務 外
        </span>
        <h2 class="fw-bold mb-4" id="attendance-date">
            {{ \Carbon\Carbon::now()->translatedFormat('Y年n月j日(D)') }}
        </h2>
        <h1 class="fw-bold display-4 mb-4" id="clock">{{ now()->format('H:i') }}</h1>
        {{-- ボタンエリア --}}
        <div id="buttons">
            <button class="btn btn-dark mt-4 px-5 py-2" id="clock-in">出勤</button>
        </div>

        {{-- お疲れ様テキスト --}}
        <div id="thanks-message" class="mt-4 fw-bold" style="display: none; font-size: 1.5rem;">
            お疲れ様でした。
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let status = '勤務外';

        const statusLabel = document.getElementById("status-label");
        const buttonsDiv = document.getElementById("buttons");
        const thanksMessage = document.getElementById("thanks-message");

        function updateStatus(newStatus) {
            status = newStatus;
            statusLabel.textContent = newStatus;

            if (status === '勤務中') {
                buttonsDiv.innerHTML = `
                    <button class="btn btn-warning mt-4 px-5 py-2 me-2" id="break-start">休憩</button>
                    <button class="btn btn-danger mt-4 px-5 py-2" id="clock-out">退勤</button>
                `;
            } else if (status === '休憩中') {
                buttonsDiv.innerHTML = `
                    <button class="btn btn-success mt-4 px-5 py-2" id="break-end">休憩戻り</button>
                `;
            } else if (status === '退勤済') {
                buttonsDiv.style.display = "none";
                thanksMessage.style.display = "block";
            }

            bindEvents(); // ボタンを入れ替えた後は再バインド
        }

        function bindEvents() {
            const clockIn = document.getElementById("clock-in");
            const breakStart = document.getElementById("break-start");
            const breakEnd = document.getElementById("break-end");
            const clockOut = document.getElementById("clock-out");

            if (clockIn) {
                clockIn.addEventListener("click", () => updateStatus("勤務中"));
            }
            if (breakStart) {
                breakStart.addEventListener("click", () => updateStatus("休憩中"));
            }
            if (breakEnd) {
                breakEnd.addEventListener("click", () => updateStatus("勤務中"));
            }
            if (clockOut) {
                clockOut.addEventListener("click", () => updateStatus("退勤済"));
            }
        }

        bindEvents(); // 初回バインド
    });
</script>
@endsection

