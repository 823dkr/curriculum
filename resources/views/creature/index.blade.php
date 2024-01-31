@extends('layout')
@section('content')
<main>
    <a class="btn btn-primary" href="/creatures/create" role="button">生体新規登録</a>

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
                <option value="" hidden>雌雄選択</option>
                @foreach($sexes as $sex)
                <option value="{{$sex['id']}}">{{$sex['name']}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">検索</button>
        </form>
    </div>
    </div>
    </div>

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
                    <td>画像</td>
                    <td>{{$creature['name']}}</td>
                    @foreach($sexes as $sex)
                    @if($creature['sex_id']==$sex['id'])
                    <td>{{$sex['name']}}</td>
                    @endif
                    @endforeach

                    <td>
                        <form action="/creatures/{{$creature->id}}/edit" method="get">
                            @csrf
                            <button class='btn btn-secondary'>編集</button>
                        </form>
                    </td>
                    <td>
                        <form action="/creatures/{{$creature->id}}" method="post">
                            @method('delete')
                            @csrf
                            <button class='btn btn-danger' onclick="return confirm('{{$creature->name}}を削除してよろしいですか?')">削除</button>
                        </form>
                    </td>
                    <td>
                        @if(!$creature->isFeedBy(Auth::user()))
                        <span class="feeds">
                            <i class="fa-solid fa-utensils feed-toggle" data-creature-id="{{ $creature->id }}"> お腹空いた...</i>

                        </span>
                        @else
                        <span class="feeds">
                            <i class="fa-solid fa-utensils feed-toggle feeded" data-creature-id="{{ $creature->id }}"> ごちそうさま！！</i>
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