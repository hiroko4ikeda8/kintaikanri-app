@extends('layouts.app')

@section('title', '勤怠詳細画面（管理者）')

@section('header')
    @include('layouts.header.admin-header')
@endsection

@section('content')
<div class="container mt-4 index-container">
    <h1 class="fw-bold">| 勤怠詳細</h1>

    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table" style="border-radius: 10px; overflow: hidden;">
                <tbody>
                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">名前</th>
                    <td style="width: 40%; padding-top: 30px;">{{ $attendance->user->name }}</td>
                    <td style="width: 30%;"></td>
                  </tr>

                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">日付</th>
                    <td style="width: 40%; padding-top: 30px;">
                      {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('Y年n月j日') }}
                    </td>
                    <td></td>
                  </tr>

                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">出勤・退勤</th>
                    <td style="width: 40%; padding-top: 30px;">
                      {{ \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') }} ～ 
                      {{ \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') }}
                    </td>
                    <td></td>
                  </tr>

                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">休憩</th>
                    <td style="width: 40%; padding-top: 30px;">
                      {{ $attendance->break1_start ? \Carbon\Carbon::parse($attendance->break1_start)->format('H:i') : '―' }} ～ 
                      {{ $attendance->break1_end ? \Carbon\Carbon::parse($attendance->break1_end)->format('H:i') : '―' }}
                    </td>
                    <td></td>
                  </tr>

                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">休憩2</th>
                    <td style="width: 40%; padding-top: 30px;">
                      {{ $attendance->break2_start ? \Carbon\Carbon::parse($attendance->break2_start)->format('H:i') : '―' }} ～ 
                      {{ $attendance->break2_end ? \Carbon\Carbon::parse($attendance->break2_end)->format('H:i') : '―' }}
                    </td>
                    <td></td>
                  </tr>

                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">備考</th>
                    <td style="padding-top: 30px;">
                      {{ $attendance->remarks ?? '―' }}
                    </td>
                    <td></td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 修正ボタン -->
    <div id="request-button-wrapper" class="text-end mt-4">
      <button id="request-btn" class="btn btn-dark px-5 py-2 me-4">承認</button>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const requestBtn = document.getElementById('request-btn');

        if (requestBtn) {
            requestBtn.addEventListener('click', () => {
                requestBtn.style.backgroundColor = '#696969'; // ✅ ボタンの色を変更
                requestBtn.innerText = '承認済み'; // ✅ ボタンのテキストを変更
            });
        }
    });
</script>
@endsection