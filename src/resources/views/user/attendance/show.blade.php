@extends('layouts.app')

@section('title', '勤怠詳細画面（一般ユーザー）')

@section('header')
    @include('layouts.header.user-header')
@endsection

@section('content')
<div class="container mt-4 index-container">
    <h1 class="fw-bold">| 勤怠詳細</h1>

    <div class="row mt-4">
        <!-- 縦型テーブル -->
        <div class="col-md-12">
            <table class="table" style="border-radius: 10px; overflow: hidden;">
                <tbody>
                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">名前</th>
                    <td style="width: 40%; padding-top: 30px;">西 怜奈</td>
                    <td style="width: 30%;"></td>
                  </tr>
                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">日付</th>
                    <td style="width: 40%;">
                      <div style="display: flex; flex-direction: column; gap: 10px; padding-top: 30px;">
                        <!-- 日付 -->
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                          <div>2023年</div>
                          <div>6月1日</div>
                        </div>
                      </div>
                    </td>
                    <td></td>
                  </tr>
                  
                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">出勤・退勤</th>
                    <td style="width: 40%;">
                        <div style="display: flex; flex-direction: column; gap: 10px; padding-top: 30px;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                              <input type="text" name="clock_in" class="form-control" style="width: 120px;"
                                     placeholder="09:00"
                                     value="{{ \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') }}">
                              <div>～</div>
                              <input type="text" name="clock_out" class="form-control" style="width: 120px;"
                                     placeholder="18:00"
                                     value="{{ \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') }}">
                            </div>
                        </div>
                    </td>
                    <td></td>
                  </tr>
                  
                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">休憩</th>
                    <td style="width: 40%;">
                        <div style="display: flex; flex-direction: column; gap: 10px; padding-top: 30px;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                              <input type="text" name="clock_in" class="form-control" style="width: 120px;"
                                     placeholder="09:00"
                                     value="{{ \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') }}">
                              <div>～</div>
                              <input type="text" name="clock_out" class="form-control" style="width: 120px;"
                                     placeholder="18:00"
                                     value="{{ \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') }}">
                            </div>
                        </div>
                    </td>
                    <td></td>
                  </tr>
                  
                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">休憩2</th>
                    <td style="width: 40%;">
                      <div style="display: flex; flex-direction: column; gap: 10px; padding-top: 30px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                          <input type="text" name="break2_start" class="form-control" style="width: 120px;"
                                 value="{{ $attendance->break2_start ? \Carbon\Carbon::parse($attendance->break2_start)->format('H:i') : '' }}">
                          <div>～</div>
                          <input type="text" name="break2_end" class="form-control" style="width: 120px;"
                                 value="{{ $attendance->break2_end ? \Carbon\Carbon::parse($attendance->break2_end)->format('H:i') : '' }}">
                        </div>
                      </div>
                    </td>
                    <td></td>
                  </tr>

                  <tr style="height: 90px;">
                    <th style="padding-left: 50px; width: 30%; padding-top: 30px;">備考</th>
                    <td>
                      <textarea class="form-control" rows="3" style="resize: vertical;">{{ $attendance->remarks ?? '' }}</textarea>
                    </td>
                    <td></td>
                  </tr>                  
                </tbody>
              </table>
              
        </div>
    </div>

    <!-- 修正ボタン -->
    <div class="text-center mt-4">
        <button class="btn btn-dark px-5 py-2">修正</button>
    </div>
</div>
@endsection
