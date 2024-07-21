@extends('layouts.app')

@section('title', '飲食店一覧')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="main-search-container">
    <div class="search-container">
        <form action="/" method="GET" class="search-form">
            <div class="select-box">
                <select name="area" id="area-select">
                    <option value="">All area </option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : '' }}>
                            {{ $area->area_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="separator"></div>
            <div class="select-box">
                <select name="genre" id="genre-select">
                    <option value="">All genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                            {{ $genre->genre_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="separator"></div>
            <button type="submit" class="search-button"></button>
            <div class="search-box">
                <input type="text" name="keyword" placeholder="Search ..." value="{{ request('keyword') }}">
            </div>
        </form>
    </div>
</div>
<div class="shop-list">
    @foreach ($shops as $shop)
    <div class="shop-item">
        <div class="image-container">
            <img src="{{ asset('storage/shop_images/' . $shop->shop_image) }}" alt="{{ $shop->shop_name }}" class="shop-image">
        </div>
        <div class="shop-details">
            <div class="shop-name">
                <h2>{{ $shop->shop_name }}</h2>
            </div>
            <div class="area-genre-name">
                <p>#{{ $shop->area->area_name }} #{{ $shop->genre->genre_name }}</p>
            </div>
            <div class="button-container">
                <a href="{{ route('shops.show', $shop->id) }}" class="detail-link">詳しくみる</a>
                <button class="favorite-btn" data-shop-id="{{ $shop->id }}">
                    @if(Auth::check() && $shop->favorites->where('user_id', Auth::id())->isNotEmpty())
                    <span class="heart active">&#x2764;</span>
                    @else
                    <span class="heart">&#x2764;</span>
                    @endif
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection