@extends('layouts.app')

@section('title', '勤怠一覧画面（一般ユーザー）')

@section('header')
    @include('layouts.header.user-header')
@endsection

@section('content')
<div class="container mt-4 index-container">
    <h1 class="fw-bold">| 勤怠一覧</h1>

    <!-- 月切り替えコンテナ -->
    <div class="d-flex align-items-center justify-content-between my-5 py-3 bg-white rounded px-4">
        <a href="#" id="prev-month" class="month-switch-link text-dark">
            <img src="{{ asset('images/arrow.png') }}" alt="前月" style="width: 16px; height: 16px; transform: rotate(180deg); margin-right: 4px;">
            前月
        </a>
        <span class="fw-bold" id="displayed-month">
            <img src="{{ asset('images/calendar_icon.png') }}" alt="カレンダーアイコン"  style="width: 24px; height: 24px; margin-right: 6px;">
            <i class="bi bi-calendar"></i> {{ $formattedMonth }}
        </span>
        
        <a href="#" id="next-month" class="month-switch-link text-dark">
            翌月
            <img src="{{ asset('images/arrow.png') }}" alt="翌月" style="width: 16px; height: 16px; margin-left: 4px;">
        </a>       
    </div>

    <!-- 勤怠一覧テーブル -->
    <table class="table table-bordered text-center index-table">
        <thead class="bg-white index-header">
            <tr>
                <th>日付</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩</th>
                <th>合計</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($attendances as $attendance)
                <tr>
                    <td style="color:#737373;">
                        {{ \Carbon\Carbon::parse($attendance->attendance_date)->translatedFormat('m/d(D)') }}
                    </td>
                    <td style="color:#737373;">
                        {{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') : '-' }}
                    </td>
                    <td style="color:#737373;">
                        {{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') : '-' }}
                    </td>
                    <td style="color:#737373;">
                        @php
                            $totalBreak = $attendance->breakTimes->sum(function($break) {
                                return \Carbon\Carbon::parse($break->break_end)->diffInMinutes(\Carbon\Carbon::parse($break->break_start));
                            });
                        @endphp
                        {{ floor($totalBreak / 60) . ':' . str_pad($totalBreak % 60, 2, '0', STR_PAD_LEFT) }}
                    </td>
                    <td style="color:#737373;">
                        @if ($attendance->total_work_time)
                            {{ floor($attendance->total_work_time / 60) . ':' . str_pad($attendance->total_work_time % 60, 2, '0', STR_PAD_LEFT) }}
                        @else
                            -
                        @endif
                    </td>
                    <td><a href="{{ route('attendance.show', ['id' => $attendance->id])}}" class="text-dark text-decoration-none">詳細</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="color:#737373;">データがありません</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const prevMonthBtn = document.getElementById('prev-month');
        const nextMonthBtn = document.getElementById('next-month');
        const monthDisplay = document.getElementById('displayed-month');

        let currentMonth = '{{ $formattedMonth }}';

        // 前月
        prevMonthBtn.addEventListener('click', function (e) {
            e.preventDefault();

            const [year, month] = currentMonth.split('/').map(Number);
            const date = new Date(year, month - 2); // JavaScriptの月は0始まり
            const newYear = date.getFullYear();
            const newMonth = String(date.getMonth() + 1).padStart(2, '0');

            currentMonth = `${newYear}/${newMonth}`;
            updateMonthDisplay();
        });

        // 翌月
        nextMonthBtn.addEventListener('click', function (e) {
            e.preventDefault();

            const [year, month] = currentMonth.split('/').map(Number);
            const date = new Date(year, month); // 翌月（0始まりでなくそのまま渡す）
            const newYear = date.getFullYear();
            const newMonth = String(date.getMonth() + 1).padStart(2, '0');

            currentMonth = `${newYear}/${newMonth}`;
            updateMonthDisplay();
        });

        function updateMonthDisplay() {
            monthDisplay.innerHTML = `
                <img src="{{ asset('images/calendar_icon.png') }}" alt="カレンダーアイコン" style="width: 24px; height: 24px; margin-right: 6px;">
                <i class="bi bi-calendar"></i> ${currentMonth}
            `;
        }
    });
</script>
@endsection
