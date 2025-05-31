@extends('layouts.app')

@section('title', '勤務登録画面（一般ユーザー）')

@section('header')
    @include('layouts.header.user-header')
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="text-center">
        @php
            // 初期状態のステータス（例）
            $status = '勤務外';
        @endphp

        <span id="status-label" class="d-inline-block px-3 py-1 rounded-pill fw-bold mb-4"
            style="background-color: #C8C8C8; color: #696969; letter-spacing: 0.15em;">
            {{ $status }}
        </span>

        <h2 class="fw-bold mb-4" id="attendance-date">
            {{ \Carbon\Carbon::now()->translatedFormat('Y年n月j日(D)') }}
        </h2>
        <h1 class="display-4 mb-4" id="clock" style="font-weight: 900;">{{ now()->format('H:i') }}</h1>
        {{-- ボタンエリア --}}
        <div id="buttons">
            <button class="btn btn-dark mt-4 btn-create" id="clock-in">出勤</button>
        </div>

        {{-- お疲れ様テキスト --}}
        <div id="thanks-message" class="mt-4 fw-bold" style="display: none; font-size: 1.2rem; letter-spacing: 0.1em;">
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

        function insertSpaces(str) {
            return str.split('').join(' ');
        }

        function updateStatus(newStatus) {
            status = newStatus;
            statusLabel.textContent = newStatus;  // 文字列そのまま表示

            if (status === '出勤中') {
                buttonsDiv.innerHTML = `
                    <button class="btn btn-dark mt-4 btn-create" id="clock-out">退勤</button>
                    <button class="btn btn-break mt-4 btn-create" id="break-start">休憩入</button>
                `;
            } else if (status === '休憩中') {
                buttonsDiv.innerHTML = `
                    <button class="btn btn-break mt-4 btn-create" id="break-end">休憩戻</button>
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
                clockIn.addEventListener("click", () => updateStatus("出勤中"));
            }
            if (breakStart) {
                breakStart.addEventListener("click", () => updateStatus("休憩中"));
            }
            if (breakEnd) {
                breakEnd.addEventListener("click", () => updateStatus("出勤中"));
            }
            if (clockOut) {
                clockOut.addEventListener("click", () => updateStatus("退勤済"));
            }
        }

        bindEvents(); // 初回バインド
    });
</script>
@endsection

