@extends('layout')
@section('content')
<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ isset($authgroup) ? "管理専用  " : ""}}{{ __('ログイン') }}</div>

                <div class="card-body">
                    @isset($authgroup)
                    <form method="POST" action="{{ url('login/admin') }}">
                        @else
                        <form method="POST" action="{{ route('login') }}">
                            @endisset
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('ログイン') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="col align-self-center">
                                        @if (Route::has(isset($authgroup) ? $authgroup.'.password.request' : 'password.request'))
                                        <div class="col">
                                            <a class="btn btn-link" href="{{ route(isset($authgroup) ? $authgroup.'.password.request' : 'password.request') }}">
                                                {{ __('パスワードをお忘れの方') }}
                                            </a>
                                            @endif
                                        </div>
                                        @isset($authgroup)
                                        <div class="col">
                                            <a class="btn btn-link" href="{{ url('register/admin') }}">
                                                {{ __('新規登録') }}
                                            </a>
                                        </div>
                                        <div class="col">
                                            @else
                                            <a class="btn btn-link" href="{{ route('register') }}">
                                                {{ __('新規登録') }}
                                            </a>
                                        </div>
                                        @endisset

                                        @isset($authgroup)
                                        @else
                                        <div class="col">
                                            <a class="btn btn-link" href="{{ url('login/admin') }}">
                                                {{ __('管理ユーザーはこちら') }}
                                            </a>
                                        </div>
                                        @endisset
                                    </div>
                                </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection