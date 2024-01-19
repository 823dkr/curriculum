@extends('layout')
@section('content')
<main>
    <form action="{{route('create.creature')}}" method="post" enctype='multipart/form-data'>
        @csrf
        <input type="file" name="image">

        <div class="form-group">
            <label class="sr-only">カテゴリ名</label>
            <select name='type_id' class="form-control">
                @foreach($types as $type)
                <option value="{{ $type['id']}}">{{ $type['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="sr-only">モルフ名</label>
            <input name="name" type="text" class="form-control" id="lg_email" placeholder="モルフ名">
        </div>

        <div class="form-group">
            <label class="sr-only">性別</label>
            <select name='sex' class="form-control">
                <option value='0'>不明</option>
                <option value='1'>オス</option>
                <option value='2'>メス</option>
            </select>
        </div>

        <div class='row justify-content-center'>
            <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
        </div>

    </form>
</main>
@endsection