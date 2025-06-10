@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/item.css')}}">
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
<div class="wrapper">
    <div class="item-img">
        <img src="{{ asset('storage/' . $itemListing->images->first()->image_url) }}" alt="商品画像">
        @if ($itemListing->purchase)
            <span class="sold-label">Sold</span>
        @endif
    </div>
    <div class="item-details">
        <section class="item-details__main">
            <h3 class="item-details__name">{{ $itemListing->item_name }}</h3>
            <p class="item-details__brand"> {{ $itemListing->brand_name }}</p>
            <p class="item-details__price">¥{{ number_format($itemListing->price) }} (税込)</p>
            <form action="/item/{{ $itemListing->id }}/like" method="post">
                @csrf
            <div class="item-details__icons">
                <div class="item-details__icons--like">
                    @php
                    $isLiked = Auth::check() && Auth::user()->likedListings->contains($itemListing->id);
                    @endphp
                    <label>
                        <img src="{{asset('images/star.png')}}" alt="いいね" class="{{ $isLiked ? 'liked' : '' }}">
                        <input type="submit">
                    </label>
                    <span>{{ $itemListing->likes_count ?? 0 }}</span>
                </div>
                <div class="item-details__icons--comment">
                    <img src="{{ asset('images/message.png') }}" alt="コメント">
                    <span>{{ $itemListing->comments_count ?? 0 }}</span>
                </div>
            </div>
            </form>
        </section>
            <a href="/purchase/{{ $itemListing->id}}" class="purchase-button">購入手続きへ</a>
        <section class="item-details__description">
            <h4>商品説明</h4>
            <p>{{ $itemListing->description }}</p>
        </section>
        <section class="item-details__info">
            <h4>商品の情報</h4>
            <div class="item-details__category">
                <p class="item-details__category__ttl">カテゴリー</p>
                <div class="item-details__category__data">
                    @foreach ($itemListing->categories as $category)
                    <p>{{ $category->category_name }}</p>
                    @endforeach
                </div>
            </div>
            <div class="item-details__condition">
                <p class="item-details__condition__ttl">商品の状態</p>
                <p class="item-details__condition__label">{{$itemListing->condition_label}}</p>
            </div>
        </section>
        <form action="/item/{{ $itemListing->id }}/comment" method="post">
            @csrf
        <section class="item-details__comments">
            <h4>コメント({{$itemListing->comments_count ?? 0}})</h4>
            @if ($itemListing->comments_count >= 1)
                @foreach ($itemListing->comments as $comment)
                    @php
                        $profileUrl = optional($comment->user->myPage)->profile_image_url;
                    @endphp
                    <div class="item-details__comment-info">
                        <div class="item-details__comment-info__user-icon">
                            @if ($profileUrl)
                            <img src="{{ asset($profileUrl) }} "alt="プロフィール画像">
                            @else
                            <div class="empty"></div>
                            @endif
                        </div>
                        <p class="item-details__comment-info__user-name">{{$comment->user->name}}</p>
                    </div>
                    <p class="item-details__comment__text">{{ $comment->content }}</p>
                @endforeach
            @else
                <p class="item-details__comment__text">まだコメントはありません</p>
            @endif
            <div class="item-details__comment-input">
                <h5>商品へのコメント</h5>
                <textarea name="content">{{ old('content') }}</textarea>
            </div>
            @if ($errors->any())
            <div class="form__error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            <label class="comment-button">コメントを送信する
                <input type="submit" value="コメントを送信する">
            </label>
        </section>
        </form>
    </div>
</div>
@endsection

