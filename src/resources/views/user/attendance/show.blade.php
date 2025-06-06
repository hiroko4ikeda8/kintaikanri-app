@extends('layouts.app')

@section('title', '勤怠詳細画面（一般ユーザー）')

@section('header')
    @include('layouts.header.user-header')
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
                    <td style="width: 40%; padding-top: 30px;">西　怜奈</td>
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
                    <td style="width: 40%; padding-top: 20px;">
                      <div class="d-flex align-items-center mb-2" style="width: 66.66%; gap: 0.5rem;">
                        <div style="flex: 1;">
                          <input
                            type="text"
                            id="clock_in"
                            class="form-control"
                            style="height: 35px;"
                            value="{{ \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') }}"
                            onchange="console.log('出勤時刻変更:', this.value)"
                          >
                        </div>
                        <div style="padding: 0 0.5rem; white-space: nowrap;">～</div>
                        <div style="flex: 1;">
                          <input
                            type="text"
                            id="clock_out"
                            class="form-control"
                            style="height: 35px;"
                            value="{{ \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') }}"
                            onchange="console.log('退勤時刻変更:', this.value)"
                          >
                        </div>
                      </div>
                    </td>
                    <td></td>
                  </tr>
                  
                  <tr style="height: 90px;"> 
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">休憩</th>
                    <td style="width: 40%; padding-top: 20px;">
                      @if ($attendance->breakTimes->isNotEmpty())
                        @foreach ($attendance->breakTimes as $index => $break)
                          <div class="d-flex align-items-center mb-2" style="width: 66.66%; gap: 0.5rem;">
                            <div style="flex: 1;">
                              <input
                                type="text"
                                class="form-control"
                                style="height: 35px;"
                                value="{{ \Carbon\Carbon::parse($break->break_start)->format('H:i') }}"
                                onchange="console.log('休憩{{ $index + 1 }}開始変更:', this.value)"
                              >
                            </div>
                            <div style="padding: 0 0.5rem; white-space: nowrap;">～</div>
                            <div style="flex: 1;">
                              <input
                                type="text"
                                class="form-control"
                                style="height: 35px;"
                                value="{{ \Carbon\Carbon::parse($break->break_end)->format('H:i') }}"
                                onchange="console.log('休憩{{ $index + 1 }}終了変更:', this.value)"
                              >
                            </div>
                          </div>
                        @endforeach
                      @else
                        ―
                      @endif
                    </td>
                    <td></td>
                  </tr>
                  
                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">休憩2</th>
                    <td style="width: 40%; padding-top: 20px;">
                      <div class="d-flex align-items-center" style="width: 66.66%; gap: 0.5rem;">
                        <div style="flex: 1;">
                          <input
                            type="text"
                            id="break2_start"
                            class="form-control"
                            style="height: 35px;"
                            value="{{ $attendance->break2_start ? \Carbon\Carbon::parse($attendance->break2_start)->format('H:i') : '' }}"
                            onchange="console.log('休憩2開始変更:', this.value)"
                          >
                        </div>
                        <div style="padding: 0 0.5rem; white-space: nowrap;">
                          ～
                        </div>
                        <div style="flex: 1;">
                          <input
                            type="text"
                            id="break2_end"
                            class="form-control"
                            style="height: 35px;"
                            value="{{ $attendance->break2_end ? \Carbon\Carbon::parse($attendance->break2_end)->format('H:i') : '' }}"
                            onchange="console.log('休憩2終了変更:', this.value)"
                          >
                        </div>
                      </div>
                    </td>
                    <td></td>
                  </tr>

                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 40px;">備考</th>
                    <td style="padding-top: 20px; width: 40%;">
                      <textarea
                        class="form-control"
                        style="max-width: 400px; height: 80px; resize: none;"
                        placeholder="申請理由を入力"
                        onchange="console.log('備考変更:', this.value)"
                      >{{ $attendance->remarks ?? '' }}</textarea>
                    </td>
                    <td></td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 修正ボタン -->
    <div id="request-button-wrapper" class="text-end mt-4">
      <button id="request-btn" class="btn btn-dark px-5 py-2 me-4">修正</button>
    </div>

    <!-- 承認待ちメッセージ -->
    <div id="pending-message" class="text-end fw-bold mt-3 me-4" style="display: none; color: #FF000080;">
      *承認待ちのため修正はできません。
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const requestBtn = document.getElementById('request-btn');
        const buttonWrapper = document.getElementById('request-button-wrapper');
        const pendingMsg = document.getElementById('pending-message');

        if (requestBtn && buttonWrapper && pendingMsg) {
            requestBtn.addEventListener('click', () => {
                buttonWrapper.style.display = 'none';
                pendingMsg.style.display = 'block';
            });
        }
    });
</script>
@endsection
