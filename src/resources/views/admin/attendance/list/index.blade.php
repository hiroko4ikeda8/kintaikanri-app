@extends('layouts.app')

@section('title', '勤怠一覧画面(管理者)')

@section('header')
    @include('layouts.header.admin-header')
@endsection

@section('content')
<div class="container mt-4 index-container">
    <h1 class="fw-bold">| {{ $formattedDate }} の勤怠</h1>

    <!-- 日付切り替えコンテナ -->
    <div class="d-flex align-items-center justify-content-between my-5 py-3 bg-white rounded px-4">
        <a href="#" id="prev-day" class="date-switch-link text-dark">
            <img src="{{ asset('images/arrow.png') }}" alt="前日" style="width: 16px; height: 16px; transform: rotate(180deg); margin-right: 4px;">
            前日
        </a>
        <span class="fw-bold" id="displayed-date">
            <img src="{{ asset('images/calendar_icon.png') }}" alt="カレンダーアイコン" style="width: 24px; height: 24px; margin-right: 6px;">
            <i class="bi bi-calendar"></i> {{ $formattedDate }}
        </span>
        <a href="#" id="next-day" class="date-switch-link text-dark">
            翌日
            <img src="{{ asset('images/arrow.png') }}" alt="翌日" style="width: 16px; height: 16px; margin-left: 4px;">
        </a>
    </div>

    <!-- 勤怠一覧テーブル -->
    <table class="table table-bordered text-center index-table">
        <thead class="bg-white index-header">
            <tr>
                <th>名前</th>
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
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') : '-' }}</td>
                    <td>{{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') : '-' }}</td>
                    <td>
                        @php
                            $totalBreak = $attendance->breakTimes->sum(function($break) {
                                return \Carbon\Carbon::parse($break->break_end)->diffInMinutes(\Carbon\Carbon::parse($break->break_start));
                            });
                        @endphp
                        {{ floor($totalBreak / 60) . ':' . str_pad($totalBreak % 60, 2, '0', STR_PAD_LEFT) }}
                    </td>
                    <td>
                        @if ($attendance->total_work_time)
                            {{ floor($attendance->total_work_time / 60) . ':' . str_pad($attendance->total_work_time % 60, 2, '0', STR_PAD_LEFT) }}
                        @else
                            -
                        @endif
                    </td>
                    <td><a href="{{ route('admin.attendance.show', ['id' => $attendance->id]) }}" class="text-dark text-decoration-none">詳細</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">データがありません</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
