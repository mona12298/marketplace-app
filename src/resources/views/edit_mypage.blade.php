@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/edit_mypage.css')}}">
@endsection

@section('header-menu')
<div class="header-btn">
    <input type="text" name="search" placeholder="なにをお探しですか？">
</div>
<nav class="header-nav">
    <ul>
        <li>
            <form action="/logout" method="post">
                @csrf
                <input class="header-link"  type="submit" value="ログアウト" >
            </form>
        </li>
        <li><a class="header-link" href="/mypage">マイページ</a></li>
        <li><a class="header-link header-link--last" href="/sell">出品</a></li>
    </ul>
</nav>
@endsection

@section('content')
<form action="/mypage/profile" method="post" enctype="multipart/form-data">
@csrf
@method('patch')
<div class="content">
    <h2 class="content-title">
        プロフィール設定
    </h2>
    <div class="content-img">
        <div class="content-img__icon">
            <img id="profile-preview" src="{{ isset($myPage) && $myPage->profile_image_url ? asset($myPage->profile_image_url) : '' }}" alt="プロフィール画像" class="{{ isset($myPage) && $myPage->profile_image_url ? '' : 'empty' }}">
        </div>
        <label class="content-img__btn">
            <p>画像を選択する</p>
            <input id="profile_image_url" type="file" name="profile_image_url" accept=".jpeg, .png">
        </label>
    </div>

    <div class="form-item">
        <div class="form-item__ttl">
            <span>ユーザー名</span>
        </div>
        <div class="form-input">
            <input type="text" name="name" value="{{ old('name') ?? auth()->user()->name }}">
        </div>
        <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form-item">
        <div class="form-item__ttl">
            <span>郵便番号</span>
        </div>
        <div class="form-input">
            <input type="text" name="postcode" value="{{ old('postcode') ??  $myPage->postcode ?? '' }}">
        </div>
        <div class="form__error">
            @error('postcode')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form-item">
        <div class="form-item__ttl">
            <span>住所</span>
        </div>
        <div class="form-input">
            <input type="text" name="address" value="{{ old('address') ??  $myPage->address ?? '' }}">
        </div>
        <div class="form__error">
            @error('address')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form-item">
        <div class="form-item__ttl">
            <span>建物名</span>
        </div>
        <div class="form-input">
            <input type="text" name="building" value="{{ old('building') ??  $myPage->building ?? '' }}">
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
</div>
</form>

@section('js')
<script>
    const input = document.getElementById('profile_image_url');
    const preview = document.getElementById('profile-preview');

    input.addEventListener('change', () => {
        const file = input.files[0];
        if (!file) {
            preview.src = '';
            preview.classList.add('empty');
            return;
        }
        const reader = new FileReader();
        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.classList.remove('empty');
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection

@endsection
