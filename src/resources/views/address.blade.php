@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/address.css')}}">
@endsection

@section('header-menu')
<form action="/" method="get">
<div class="header-btn">
    <input type="text" name="search" value="{{ old('keyword', $keyword ?? '') }}"  placeholder="なにをお探しですか？">
</div>
</form>
<nav class="header-nav">
    <ul>
        <li>
            @auth
            <form action="/logout" method="post">
                @csrf
                <input class="header-link"  type="submit" value="ログアウト" >
            </form>
            @endauth
            @guest
            <a href="/login" class="header-link">ログイン</a>
            @endguest
        </li>
        <li><a class="header-link" href="/mypage">マイページ</a></li>
        <li><a class="header-link header-link--last" href="/sell">出品</a></li>
    </ul>
</nav>
@endsection

@section('content')
<div class="content">
    <form action="/purchase/address/{{$itemListing->id}}" method="post">
        @csrf
        @method('PATCH')
        <h2 class="content-title">
            住所の変更
        </h2>
        <div class="form-item">
            <div class="form-item__ttl">
                <label for="postcode">郵便番号</label>
            </div>
            <div class="form-input">
                <input type="text" name="postcode" id="postcode" value="{{ old('postcode') }}">
            </div>
            <div class="form__error">
                @error('postcode')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-item">
            <div class="form-item__ttl">
                <label for="address">住所</label>
            </div>
            <div class="form-input">
                <input id="address" type="text" name="address" value="{{ old('address') }}">
            </div>
            <div class="form__error">
                @error('address')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-item">
            <div class="form-item__ttl">
                <label for="building">建物名</label>
            </div>
            <div class="form-input">
                <input type="text" id="building" name="building" value="{{ old('building') }}">
            </div>
            <div class="form__error">
                @error('building')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-btn">
            <input type="submit" value="更新する">
        </div>
    </form>
</div>
@endsection