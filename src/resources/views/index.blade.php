@extends('layouts.app')

@section('title', '飲食店一覧')

@section('content')
        <form action="/" method="GET" style="display: flex; align-items: center;">
            <select name="area" style="margin-right: 10px;">
                <option value="">エリアを選択</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                @endforeach
            </select>
            <select name="genre" style="margin-right: 10px;">
                <option value="">ジャンルを選択</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                @endforeach
            </select>
            <input type="text" name="keyword" placeholder="キーワード検索" style="margin-right: 10px;">
            <button type="submit">検索</button>
        </form>
        <div class="shop-list">
            <!-- 飲食店舗のリストをここに表示 -->
            @foreach ($shops as $shop)
                <div class="shop-item" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                    <img src="{{ $shop->shop_image }}" alt="{{ $shop->shop_name }}" style="width: 100px; height: 100px;">
                    <h2>{{ $shop->shop_name }}</h2>
                    <p>エリア: {{ $shop->area->area_name }}</p>
                    <p>ジャンル: {{ $shop->genre->genre_name }}</p>
                    <button class="favorite-btn" data-shop-id="{{ $shop->id }}">
                        @if(Auth::check() && $shop->favorites->where('user_id', Auth::id())->isNotEmpty())
                            お気に入り解除
                        @else
                            お気に入り追加
                        @endif
                    </button>
                    <a href="{{ route('shops.show', $shop->id) }}">詳細表示</a>
                </div>
            @endforeach
        </div>
@endsection


