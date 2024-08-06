@extends('layouts.app')

@section('title', '口コミ')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/assessment.css') }}">
@endsection

@section('content')
<div class="assessment-container">
    <div class="title-item">
        <h1 class="assessment-title">{{ $review ? '口コミを編集' : '今回のご利用はいかがでしたか？' }}</h1>
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
                    <a href="{{ route('shops.show', ['shop' => $shop->id]) }}" class="detail-link">
                        詳しくみる
                    </a>
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
    </div>
    <form action="{{ $review ? route('assessment.update', ['id' => $review->id]) : route('assessment.store', ['shop' => $shop->id]) }}" method="POST" enctype="multipart/form-data" class="assessment-form">
        @csrf
        @if($review)
        @method('PUT')
        @endif
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">

        <h2 class="assessment-title-sub">体験を評価してください</h2>
        <div class="rating-container">
            <div class="assessment-rating">
                <input type="radio" name="evaluation" value="5" id="evaluation-5" class="assessment-radio" {{ $review && $review->evaluation == 5 ? 'checked' : '' }}>
                <label for="evaluation-5" class="star">&#9733;</label>
                <input type="radio" name="evaluation" value="4" id="evaluation-4" class="assessment-radio" {{ $review && $review->evaluation == 4 ? 'checked' : '' }}>
                <label for="evaluation-4" class="star">&#9733;</label>
                <input type="radio" name="evaluation" value="3" id="evaluation-3" class="assessment-radio" {{ $review && $review->evaluation == 3 ? 'checked' : '' }}>
                <label for="evaluation-3" class="star">&#9733;</label>
                <input type="radio" name="evaluation" value="2" id="evaluation-2" class="assessment-radio" {{ $review && $review->evaluation == 2 ? 'checked' : '' }}>
                <label for="evaluation-2" class="star">&#9733;</label>
                <input type="radio" name="evaluation" value="1" id="evaluation-1" class="assessment-radio" {{ $review && $review->evaluation == 1 ? 'checked' : '' }}>
                <label for="evaluation-1" class="star">&#9733;</label>
            </div>
        </div>
        <div class="assessment-comment">
            <label for="comment">口コミを投稿:</label>
            <textarea name="comment" id="comment" rows="4" cols="50" class="assessment-textarea" placeholder="カジュアルな夜のお出かけにおすすめのスポット">{{ $review ? $review->comment : '' }}</textarea>
            <div id="char-count" class="assessment-char-count">0/400 最大文字数</div>
        </div>


        <div class="assessment-image-upload">
            <label for="image">画像の追加:</label>
            <div class="drop-area" onclick="document.getElementById('image').click();">
                <p>クリックして写真を追加<br>またはドラッグアンドドロップ</p>
                <input type="file" name="image" id="image" class="assessment-file-input" style="display: none;">
                <div id="file-name"></div>
                <img id="image-preview" style="display: none; max-width: 100%; ">
            </div>
        </div>

        <div class="assessment-submit">
            <button type="submit" class="assessment-submit-button">{{ $review ? '口コミを更新' : '口コミを投稿' }}</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/assessment.js') }}" defer></script>
@endsection