@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/sell.css')}}">
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
<form action="/sell" method="post" enctype="multipart/form-data">
@csrf

@php
$tmp =session('tmp_image');
$previewSrc = $tmp ? asset('storage/' . $tmp) : '';
@endphp

<div class="wrapper">
    <h2 class="page-ttl">商品の出品</h2>
    <div class="item-image">
        <p>商品画像</p>
        <div class="item-image__preview">
            <img id="image-preview" src="{{$previewSrc}}" alt="商品画像" style="{{ $previewSrc ? '' : 'display:none;' }}">
            <label for="image_url">
                画像を選択する
                <input id="image_url" type="file" name="image_url" accept=".jpeg, .png">
            </label>
        </div>

    </div>
    <h3>商品の詳細</h3>
    <div class="item-category">
        <p>カテゴリー</p>
        <div class="item-category__data">
            @foreach ($categories as $category)
                <input type="checkbox" id="{{$category->id}}" name="categories[]" value="{{$category->id}}" {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                <label for="{{$category->id}}">{{$category->category_name}}</label>
            @endforeach
        </div>
    </div>
    <div class="item-condition">
        <p>商品の状態</p>
        <div class="item-condition__select">
            <select name="condition" id="condition">
                <option value="" selected disabled hidden>選択してください</option>
                <option name="condition" value="0" {{ old('condition') == '0' ? 'selected' : '' }}>良好</option>
                <option name="condition" value="1" {{ old('condition') == '1' ? 'selected' : '' }}>目立った傷や汚れなし</option>
                <option name="condition" value="2" {{ old('condition') == '2' ? 'selected' : '' }}>やや傷や汚れあり</option>
                <option name="condition" value="3" {{ old('condition') == '3' ? 'selected' : '' }}>状態が悪い</option>
            </select>
        </div>
    </div>
    <h3>商品名と説明</h3>
    <div class="item-form">
        <label for="item_name">商品名</label>
        <input id="item_name" type="text" value="{{old('item_name')}}" name="item_name">
    </div>
    <div class="item-form">
        <label for="brand_name">ブランド名</label>
        <input id="brand_name" type="text" value="{{old('brand_name')}}" name="brand_name">
    </div>
    <div class="item-form">
        <label for="description">商品の説明</label>
        <textarea name="description" id="description">{{old('description')}}</textarea>
    </div>
    <div class="item-form price-form">
        <label for="price">販売価格</label>
        <input id="price" type="number" value="{{old('price')}}" name="price">
        <span class="yen">¥</span>
    </div>
    @if ($errors->any())
        <div class="form__error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <input class="sell-btn" type="submit" value="出品する">
</div>
</form>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('image_url');
        const preview = document.getElementById('image-preview');
        input.addEventListener('change', () => {
            const file = input.files[0];
            if (!file) {
                preview.src = '';
                preview.style.display = 'none';
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
        if (!preview.src || preview.src === window.location.href) {
            preview.style.display = 'none';
        }
    });
</script>
@endsection


@endsection
