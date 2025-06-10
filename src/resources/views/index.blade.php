@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
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
<div class="content-links">
    <a href="{{ url('/') }}" class="content-link {{ empty($tab) ? 'active' : '' }}">おすすめ</a>
    <a href="{{ url('/?tab=mylist') }}" class="content-link {{ $tab === 'mylist' ? 'active' : '' }}">マイリスト</a>
</div>

<div class="item-list-wrapper">
    @foreach ($itemListings as $itemListing)
        <div class="item-content">
            <a href="/item/{{ $itemListing->id }}" class="item-content__link">
                @if ($itemListing->images->isNotEmpty())
                    <img src="{{ asset('storage/' . $itemListing->images->first()->image_url) }}" alt="商品画像" class="item-content__img" />
                    @if ($itemListing->purchase)
                        <span class="sold-label">Sold</span>
                    @endif
                @else
                    <img src="{{ asset('default.jpg') }}" alt="商品画像" class="item-content__img" />
                @endif

                <div class="detail-content">
                    <p>{{ $itemListing->item_name }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>

@endsection