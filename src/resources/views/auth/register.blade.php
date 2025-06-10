@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')
<div class="content">
    <form action="/register" method="post">
        @csrf
        <h2 class="content-title">
            会員登録
        </h2>
        <div class="form-item">
            <div class="form-item__ttl">
                <span>ユーザー名</span>
            </div>
            <div class="form-input">
                <input type="text" name="name" value="{{ old('name') }}">
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
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
            </div>
        </div>
        <div class="form-item">
            <div class="form-item__ttl">
                <span>確認用パスワード</span>
            </div>
            <div class="form-input">
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
            </div>
            <div class="form__error">
                @error('password_confirmation')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-btn">
            <input type="submit" value="会員登録する">
        </div>
    </form>
    <div class="login-link">
        <a href="/login">ログインはこちら</a>
    </div>
</div>


@endsection