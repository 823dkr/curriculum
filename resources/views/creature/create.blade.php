@extends('layout')
@section('content')
<main>
    <div class='panel-body'>
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <form action="/creatures" method="post" enctype='multipart/form-data'>
        @csrf
        <div class="form-group">
            <div class="card-header">画像選択</div>
            <input type="file" name="image">
        </div>
        <div class="form-group">
            <label class="sr-only">カテゴリ名</label>
            <select name='type_id' class="form-control">
                <option value="" hidden>カテゴリ選択</option>
                @foreach($types as $type)
                <option value="{{ $type['id']}}">{{ $type['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <a href="/types/create">
                <button type='button' class="'btn btn-primary">カテゴリ追加</button>
            </a>
        </div>

        <div class="form-group">
            <label class="sr-only">モルフ名</label>
            <input name="name" type="text" class="form-control" id="lg_email" placeholder="モルフ名" value="{{ old('name')}}">
        </div>

        <div class=" form-group">
            <label class="sr-only">性別</label>
            <select name='sex_id' class="form-control">
                <option value="" hidden>性別選択</option>
                @foreach($sexes as $sex)
                <option value="{{$sex['id']}}">{{$sex['name']}}</option>
                @endforeach
            </select>
        </div>

        <div class='row justify-content-center'>
            <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
        </div>

    </form>
</main>
@endsection