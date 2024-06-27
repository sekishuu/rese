@extends('layouts.app')

@section('title', '飲食店一覧')

@section('content')
    <form action="/" method="GET" class="search-form">
        <select name="area">
            <option value="">エリアを選択</option>
            @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
            @endforeach
        </select>
        <select name="genre">
            <option value="">ジャンルを選択</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
            @endforeach
        </select>
        <input type="text" name="keyword" placeholder="キーワード検索">
        <button type="submit">検索</button>
    </form>
    <div class="shop-list">
        @foreach ($shops as $shop)
            <div class="shop-item">
                <img src="{{ asset('storage/shop_images/' . $shop->shop_image) }}" alt="{{ $shop->shop_name }}" class="shop-image">
                <div class="shop-details">
                    <h2>{{ $shop->shop_name }}</h2>
                    <p>#{{ $shop->area->area_name }} #{{ $shop->genre->genre_name }}</p>
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

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
