@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection


@section('content')
<div class="content">
    <form action="/login" method="post">
        @csrf
        <h2 class="content-title">
            ログイン
        </h2>
        <div class="form-item">
            <div class="form-item__ttl">
                <span>メールアドレス</span>
            </div>
            <div class="form-input">
                <input type="text" name="email" value="{{ old('email') }}">
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-item">
            <div class="form-item__ttl">
                <span>パスワード</span>
            </div>
            <div class="form-input">
                <input type="password" name="password" value="{{ old('password') }}">
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
                @error('login')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-btn">
            <input type="submit" value="ログインする">
        </div>
    </form>
    <div class="register-link">
        <a href="/register">会員登録はこちら</a>
    </div>

</div>


@endsection