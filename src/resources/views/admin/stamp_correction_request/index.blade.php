@extends('layouts.app')

@section('title', '申請一覧画面（管理者）')

@section('header')
    @include('layouts.header.admin-header')
@endsection

@section('content')
<div class="container mt-4 index-container">
    <h1 class="fw-bold mb-5">| 申請一覧</h1>

    <!-- 承認待ち・承認済みテキストのコンテナ -->
    <div class="container">
        <div class="row">
            <!-- 承認待ちテキスト -->
            <div class="col-3 text-start cursor-pointer inactive-tab" id="show-pending">承認待ち</div>

            <!-- 承認済みテキスト -->
            <div class="col-6 text-start text-secondary cursor-pointer" id="show-approved">承認済み</div>

            <div class="col-3"></div>
        </div>
    </div>

    <!-- ボーダー -->
    <hr class="border-dark">

    <!-- 申請一覧テーブル（承認待ち） -->
    <div class="container">
        <table class="table table-bordered text-center index-table" id="pending-table">
            <thead class="bg-white index-header">
                <tr>
                    <th>状態</th>
                    <th>名前</th>
                    <th>対象日時</th>
                    <th>申請理由</th>
                    <th>申請日時</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                @if($request->status == 'pending')
                <tr>
                    <td>{{ $request->status_jp }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->attendance->attendance_date; }}</td>
                    <td>{{ $request->remarks }}</td>
                    <td>{{ $request->created_at->format('Y/m/d') }}</td>
                    <td>
                        <a href="{{ route('admin.stamp_correction_request.approve', ['id' => $request->id]) }}" 
                           class="text-dark text-decoration-none">
                           詳細
                        </a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- 申請一覧テーブル（承認済み） -->
    <div class="container" id="approved-container">
        <table class="table table-bordered text-center index-table" id="approved-table">
            <thead class="bg-white index-header">
                <tr>
                    <th>状態</th>
                    <th>名前</th>
                    <th>対象日時</th>
                    <th>申請理由</th>
                    <th>申請日時</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                @if($request->status == 'pending' && $request->user->role == 'user') <!-- ✅ 一般ユーザーのみ表示 -->
                <tr>
                    <td>{{ $request->status_jp }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->attendance->attendance_date; }}</td>
                    <td>{{ $request->remarks }}</td>
                    <td>{{ $request->created_at->format('Y/m/d') }}</td>
                    <td>
                        <a href="{{ route('admin.stamp_correction_request.approve', ['id' => $request->id]) }}" 
                           class="text-dark text-decoration-none">
                           詳細
                        </a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const pendingTable = document.getElementById("pending-table");
        const approvedTable = document.getElementById("approved-table");
        const showPendingBtn = document.getElementById("show-pending");
        const showApprovedBtn = document.getElementById("show-approved");

        // 🌟 初期状態を設定（承認済みテーブルを非表示にする）
        approvedTable.classList.add("d-none");

        showPendingBtn.classList.add("active-tab");
        showApprovedBtn.classList.add("inactive-tab");

        // 承認待ちを表示
        showPendingBtn.addEventListener("click", function () {
            pendingTable.style.display = "table"; // ✅ 表示
            approvedTable.style.display = "none"; // ✅ 非表示


            // テキストの強調
            showPendingBtn.classList.add("active-tab");
            showPendingBtn.classList.remove("inactive-tab");
            showApprovedBtn.classList.remove("active-tab");
            showApprovedBtn.classList.add("inactive-tab");
        });

        // 承認済みを表示
        showApprovedBtn.addEventListener("click", function () {

            approvedTable.style.display = "table"; // ✅ 表示
            pendingTable.style.display = "none"; // ✅ 非表示


            // テキストの強調
            showApprovedBtn.classList.add("active-tab");
            showApprovedBtn.classList.remove("inactive-tab");
            showPendingBtn.classList.remove("active-tab");
            showPendingBtn.classList.add("inactive-tab");
        });
    });
</script>
@endsection