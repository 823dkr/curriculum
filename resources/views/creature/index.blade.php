@extends('layout')
@section('content')
<main>
    <br>
    <br>
    <div class="text-center">
        <a class="btn btn-outline-success  btn-lg" href="/creatures/create" role="button">生体新規登録</a>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class='text-center'>生体検索</div>
                </div>
                <div class="card-body">
                    <form action='/searches' method="get">
                        @csrf
                        <select name='type_id' class="form-control">
                            <option value="" hidden>カテゴリ選択</option>
                            @foreach($all_types as $all_type)
                            <option value="{{ $all_type['id']}}">{{ $all_type['name'] }}</option>
                            @endforeach
                        </select>
                        <select name='sex_id' class="form-control">
                            <option value="" hidden>性別選択</option>
                            @foreach($sexes as $sex)
                            <option value="{{$sex['id']}}">{{$sex['name']}}</option>
                            @endforeach
                        </select>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">検索</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    @foreach($types as $type)
    <div class="container">
        <table class=" table table-striped">
            <thead>
                <tr>
                    <th scope="col">{{$type['name']}}</th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th scope="col">生体画像</th>
                    <th scope="col">モルフ名</th>
                    <th scope="col">性別</th>
                    <th scope="col">編集</th>
                    <th scope="col">削除</th>
                    <th scope="col">給餌</th>
                </tr>
            </thead>

            @foreach($creatures as $creature)
            <tbody>
                @if($type['id'] == $creature['type_id'])
                <tr>
                    @foreach($images as $image)
                    @if(($creature['id']==$image['creature_id']))
                    <td> <img src="{{$image->path}}" class="img-thumbnail"></td>
                    @endif
                    @endforeach
                    <td>{{$creature['name']}}</td>

                    @foreach($sexes as $sex)
                    @if($creature['sex_id']==$sex['id'])
                    <td>{{$sex['name']}}</td>
                    @endif
                    @endforeach

                    <td>
                        <form action="/creatures/{{$creature->id}}/edit" method="get">
                            @csrf
                            <button class="btn btn-outline-info">編集</button>
                        </form>
                    </td>
                    <td>
                        <form action=" /creatures/{{$creature->id}}" method="post">
                            @method('delete')
                            @csrf
                            <button class='btn btn-outline-danger' onclick="return confirm('{{$creature->name}}を削除してよろしいですか?')">削除</button>
                        </form>
                    </td>
                    <td><!------------------給餌管理ボタン----------------------->
                        @if(!$creature->isFeedBy(Auth::user()))

                        <span class="feeds">
                            <i class="fa-solid fa-utensils feed-toggle" id="icon" data-creature-id="{{ $creature->id }}"> </i>
                        </span>
                        @else
                        <span class="feeds">
                            <i class="fa-solid fa-utensils feed-toggle feeded" id="icon" data-creature-id="{{ $creature->id }}"> </i>
                        </span>
                        @endif​
                    </td>
                </tr>
                @else
                @endif
            </tbody>
            @endforeach
        </table>
    </div>
    <br><br><br>
    @endforeach
    @endsection