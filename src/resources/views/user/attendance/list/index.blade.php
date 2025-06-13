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
        <tbody id="attendance-tbody">
            @forelse ($attendances as $attendance)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->translatedFormat('m/d(D)') }}</td>
                    <td>{{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') : '' }}</td>
                    <td>{{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') : '' }}</td>
                    <td>
                        @php
                            $isAbsent = is_null($attendance->clock_in) && is_null($attendance->clock_out);
                    
                            if ($isAbsent) {
                                $totalBreak = null;
                            } else {
                                $totalBreak = $attendance->breakTimes->sum(function($break) {
                                    return \Carbon\Carbon::parse($break->break_end)->diffInMinutes(\Carbon\Carbon::parse($break->break_start));
                                });
                            }
                        @endphp
                    
                        {{ !is_null($totalBreak) ? floor($totalBreak / 60) . ':' . str_pad($totalBreak % 60, 2, '0', STR_PAD_LEFT) : '' }}
                    </td>
                    <td>
                        @if ($attendance->total_work_time)
                            {{ floor($attendance->total_work_time / 60) . ':' . str_pad($attendance->total_work_time % 60, 2, '0', STR_PAD_LEFT) }}
                        @else
                            
                        @endif
                    </td>
                    <td><a href="{{ route('user.attendance.show', ['id' => $attendance->id]) }}" class="text-dark text-decoration-none">詳細</a></td>
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
            console.log("新しい現在の月（前月）:", currentMonth); // 🔍 確認

            updateMonthDisplay(newMonth); // ← 引数を渡して最新の月を適用
            fetchAttendances(currentMonth); // ← データ取得用
        });

        // 翌月
        nextMonthBtn.addEventListener('click', function (e) {
            e.preventDefault();

            const [year, month] = currentMonth.split('/').map(Number);
            const date = new Date(year, month); // 翌月（0始まりでなくそのまま渡す）
            const newYear = date.getFullYear();
            const newMonth = String(date.getMonth() + 1).padStart(2, '0');

            currentMonth = `${newYear}/${newMonth}`;
            console.log("新しい現在の月（翌月）:", currentMonth); // 🔍 確認

            updateMonthDisplay(newMonth); // ← 引数を渡して最新の月を適用
            fetchAttendances(currentMonth); // ← データ取得用
        });

        function updateMonthDisplay(newMonth) { 
            console.log("更新後の月:", newMonth);
    
            if (!newMonth) {
                console.error("エラー: `newMonth` の値が不正です");
                return;
            }

            monthDisplay.innerHTML = `
                <img src="{{ asset('images/calendar_icon.png') }}" alt="カレンダーアイコン" style="width: 24px; height: 24px; margin-right: 6px;">
                <i class="bi bi-calendar"></i> ${newMonth}
            `;
        }

        function fetchAttendances(month) {
            console.log("リクエストURL: ", `{{ route('user.attendance.ajax') }}?month=${month}`);

            fetch(`http://localhost/user/attendances/ajax?month=${month}`)
                .then(response => {
                    console.log("レスポンスステータス:", response.status);  // ✅ ステータスコード確認
                    console.log("レスポンスContent-Type:", response.headers.get("Content-Type")); // ✅ JSONかどうか確認

                    if (!response.ok) {
                        throw new Error(`HTTPエラー: ${response.status}`);
                    }

                    return response.json();
                })
                .then(data => {
                    console.log("取得した勤怠データ:", data);


                    // ✅ ここにデータ型チェックを追加！
                    if (data.attendances && Array.isArray(data.attendances)) {
                        data.attendances.forEach(attendance => {  
                        console.log("処理する勤怠データ:", attendance);
                            // 勤怠データの処理（UIに追加など）
                    });
                } else {
                    console.error("勤怠データが配列ではありません:", data.attendances);
                }

                    const tbody = document.getElementById('attendance-tbody');
                    tbody.innerHTML = ''; // ← UIクリア

                    if (!data.attendances || data.attendances.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="6">データがありません</td></tr>';
                        return;
                    }

                    Object.values(data.attendances).forEach(attendance => { // ✅ 修正
                    // 休憩時間計算
                    let totalBreak = null;
                    if (attendance.clock_in !== null || attendance.clock_out !== null) {
                        totalBreak = 0;
                        attendance.breakTimes.forEach(breakTime => {
                            const start = new Date(`1970-01-01T${breakTime.break_start}`);
                            const end = new Date(`1970-01-01T${breakTime.break_end}`);
                            totalBreak += (end - start) / 60000; // 分換算
                        });
                    }

                    // 勤務時間フォーマット
                    let totalWorkTime = '';
                    if (attendance.total_work_time) {
                        const h = Math.floor(attendance.total_work_time / 60);
                        const m = attendance.total_work_time % 60;
                        totalWorkTime = `${h}:${m.toString().padStart(2, '0')}`;
                    }

                    // 休憩時間フォーマット
                    let breakTimeStr = '';
                    if (totalBreak !== null) {
                        const bh = Math.floor(totalBreak / 60);
                        const bm = Math.floor(totalBreak % 60);
                        breakTimeStr = `${bh}:${bm.toString().padStart(2, '0')}`;
                    }

                    // 日付フォーマット (Y-m-d → m/d(D)) 日本語曜日の処理はサーバで行ったほうが確実です
                    const dateObj = new Date(attendance.attendance_date);
                    const options = { month: '2-digit', day: '2-digit', weekday: 'short' };
                    const dateStr = dateObj.toLocaleDateString('ja-JP', options).replace(/\s/g, '');

                    // 詳細URL (idが文字列の場合も考慮)
                    const detailUrl = `{{ url('user/attendance/show') }}/${attendance.id}`;

                    console.log("処理中の勤怠データ:", attendance); // 🔍 各データを確認

                    // tr生成
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${dateStr}</td>
                        <td>${attendance.clock_in ? attendance.clock_in.slice(0,5) : ''}</td>
                        <td>${attendance.clock_out ? attendance.clock_out.slice(0,5) : ''}</td>
                        <td>${breakTimeStr}</td>
                        <td>${totalWorkTime}</td>
                        <td><a href="${detailUrl}" class="text-dark text-decoration-none">詳細</a></td>
                    `;
                    tbody.appendChild(tr);
                });

                // 表示月更新
                const monthDisplay = document.getElementById('displayed-month');
                monthDisplay.innerHTML = `
                    <img src="{{ asset('images/calendar_icon.png') }}" alt="カレンダーアイコン" style="width: 24px; height: 24px; margin-right: 6px;">
                    <i class="bi bi-calendar"></i> ${data.month}
                `;

                // currentMonth 更新
                currentMonth = data.month; // ← そのまま代入

                console.log("更新後の現在の月:", currentMonth); // ✅ 期待通りの形式か確認
                console.log("UI更新後の tbody:", tbody.innerHTML); // 🔍 UIの更新確認

            })
            .catch(error => {
                console.error('勤怠データの取得エラー:', error);
                alert(`データ取得に失敗しました。\nエラー: ${error.message}`);
            });
        }
    });
</script>
@endsection
