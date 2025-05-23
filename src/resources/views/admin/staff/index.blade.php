@extends('layouts.app')

@section('title', 'スタッフ一覧画面（管理者）')

@section('header')
    @include('layouts.header.admin-header')
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold">スタッフ一覧</h1>

    <!-- スタッフ一覧テーブル -->
    <table class="table table-bordered text-center">
        <thead class="table-dark text-white">
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>月次勤怠</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>西 怜奈</td>
                <td>reuba.n@coachtech.com</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
            <tr>
                <td>山田　太郎</td>
                <td>toro.y@coachtech.com</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
            <tr>
                <td>増田　一世</td>
                <td>issei .m@coachtech.com</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
            <tr>
                <td>山本　敬吉</td>
                <td>keikidhi.y@coachtech.com</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
            <tr>
                <td>秋田　朋美</td>
                <td>tomomi.a@coachtech.com</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
            <tr>
                <td>中西　教夫</td>
                <td>norio.n@coachtech.com</td>
                <td><a href="#" class="text-dark">詳細</a></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection