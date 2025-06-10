@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/mypage.css')}}">
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

<div class="top-content">
    <div class="content__icon">
        <img src="{{ isset($myPage) && $myPage->profile_image_url ? asset($myPage->profile_image_url) : '' }}" alt="プロフィール画像" class="{{ isset($myPage) && $myPage->profile_image_url ? '' : 'empty' }}">
    </div>
    <p>{{$user->name}}</p>
    <a href="mypage/profile">プロフィールを編集</a>
</div>

<div class="tabs">
    <a href="/mypage?tab=sell" class="{{ $tab === 'sell' ? 'active' : '' }}">出品した商品</a>

    <a href="/mypage?tab=buy" class="{{ $tab === 'buy' ? 'active' : '' }}">購入した商品</a>
</div>

<div class="tab-content">
    @if($tab === 'sell')
        @foreach ($items as $item)
            <div class="content__item">
                <a href="/item/{{ $item->id }}" class="content__link">
                    @if ($item->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $item->images->first()->image_url) }}" alt="商品画像" class="content__img" />
                        @if ($item->purchase)
                            <span class="sold-label">Sold</span>
                        @endif
                    @else
                        <img src="{{ asset('default.jpg') }}" alt="商品画像" class="content__img" />
                    @endif
                    <div class="content__name">
                        <p>{{ $item->item_name }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    @elseif($tab === 'buy')
        @foreach ($items as $purchase)
            @php
                $item = $purchase->itemListing;
            @endphp
            <div class="content__item">
                <a href="/item/{{$item->id}}"  class="content__link">
                    @if ($item->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $item->images->first()->image_url) }}" alt="商品画像" class="content__img" />
                        <span class="sold-label">Sold</span>
                    @else
                        <img src="{{ asset('default.jpg') }}" alt="商品画像" class="content__img" />
                    @endif
                    <div class="content__name">
                        <p>{{$item->item_name}}</p>
                    </div>
                </a>
            </div>
        @endforeach
    @endif
</div>

@endsection