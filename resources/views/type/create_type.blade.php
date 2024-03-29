@extends('layout')
@section('content')
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
<div class="text-center" style="padding:50px 0">
    <div class="logo">カテゴリ追加</div>
    <form action='/types' method=post id="login-form" class="text-left">
        @csrf
        <div class="login-form-main-message"></div>
        <div class="main-login-form">
            <div class="login-group">
                <div class="form-group">
                    <label for="lg_type" class="sr-only">カテゴリ名</label>
                    <input type="text" class="form-control" id="lg_type" name="name" placeholder="カテゴリ名">
                </div>
                <div class='row justify-content-center'>
                    <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection