@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/purchase.css')}}">
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
<form action="/purchase/{{$itemListing->id}}" method="post">
@csrf

<div class="wrapper">
    <div class="details">
        <div class="item-listing">
            <div class="item-listing__img">
                <img src="{{ asset('storage/' . $itemListing->images->first()->image_url) }}" alt="商品画像">
                @if ($itemListing->purchase)
                    <span class="sold-label">Sold</span>
                @endif
            </div>
            <div class="item-listing__content">
                <p class="item-listing__ttl">{{ $itemListing->item_name }}</p>
                <p class="item-listing__price">¥{{ number_format($itemListing->price) }}
                </p>
            </div>
        </div>
        <div class="payment">
            <p>支払い方法</p>
            <div class="payment-select">
            <select name="payment" id="payment-method"  required>
                    <option value="" selected disabled hidden>選択してください</option>
                    <option value="1">コンビニ支払い</option>
                    <option value="2">カード支払い</option>
                </select>
            </div>
        </div>
        <div class="shipping-address">
            <div class="shipping-address-top">
                <p>配送先</p>
                <a href="/purchase/address/{{$itemListing->id}}">変更する</a>
            </div>
            <div class="shipping-address-down">
                <p>〒{{Auth::user()->myPage->postcode ?? ' 未登録'}}
                <br>
                {{ Auth::user()->myPage->address ?? '住所 未登録'}}
                </p>
            </div>
            <input type="hidden" name="postcode" value="{{ Auth::user()->myPage->postcode ?? '' }}">
            <input type="hidden" name="address" value="{{ Auth::user()->myPage->address ?? '' }}">
        </div>
    </div>
    <div class="summary">
        <div class="table">
            <div class="price-summary">
                <p>商品代金</p>
                <p>¥{{ number_format($itemListing->price) }}</p>
            </div>
            <div class="payment-summary">
                <p>支払い方法</p>
                <p id="selected-method"></p>
            </div>
        </div>
        @if ($errors->any())
        <div class="form__error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <label class="purchase-btn">購入する
            <input type="submit">
        </label>
    </div>
</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('payment-method');
    const display = document.getElementById('selected-method');

    const paymentLabels = {
        1: 'コンビニ支払い',
        2: 'カード支払い'
    };

    select.addEventListener('change', function () {
        const selectedValue = this.value;
        display.textContent = paymentLabels[selectedValue] || '未選択';
    });
});
</script>

@endsection