@extends('layout',['authgroup'=>'admin'])
@section('content')
<br>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header text-center">
                <h1>管理者ページ</h1>
            </div>
            <br>
            <br>
            <div class="container">
                <table class=" table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">
                                <h3>ユーザーリスト</h3>
                            </th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">名前</th>
                            <th scope="col">メールアドレス</th>
                            <th scope="col">削除</th>
                        </tr>
                    </thead>
                    @foreach($users as $user)
                    <tr>
                        <td scope="col">{{$user->id}}</td>
                        <td scope="col">{{$user->name}}</td>
                        <td scope="col">{{$user->email}}</td>
                        <td>
                            <form action="/admin/{{$user->id}}" method="post">
                                @method('delete')
                                @csrf
                                <button class='btn btn-danger' onclick="return confirm('{{$user->name}}を削除してよろしいですか?')">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection