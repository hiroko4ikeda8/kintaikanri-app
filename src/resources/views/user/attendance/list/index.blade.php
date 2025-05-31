@extends('layouts.app')

@section('title', '勤怠一覧画面（一般ユーザー）')

@section('header')
    @include('layouts.header.user-header')
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold">| 勤怠一覧</h1>

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
                    <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->translatedFormat('m/d(D)') }}</td>
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
                    <td><a href="#" class="text-dark">詳細</a></td>
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