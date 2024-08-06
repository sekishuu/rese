@extends('layouts.app')

@section('title', $shop->shop_name . ' - 詳細表示')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/shop-detail.css') }}">
@endsection

@section('content')
<main class="shop-detail-main">
    <div class="shop-detail-left">
        <div class="back-button-container">
            <a href="{{ route('home') }}" class="back-button">&lt;</a>
            <h2>{{ $shop->shop_name }}</h2>
        </div>
        <img src="{{ asset('storage/shop_images/' . $shop->shop_image) }}" alt="{{ $shop->shop_name }}" class="shop-image">
        <p>#{{ $shop->area->area_name }} #{{ $shop->genre->genre_name }}</p>
        <div class="shop-info">
            <p>{{ $shop->shop_info }}</p>
        </div>

        <a href="#reviews-modal" class="all-reviews-button">全ての口コミ情報</a>
        <div class="review-box">
            @if ($review)
            <dev class="edit-delete">
                <a href="{{ route('assessment.show', ['shop' => $shop->id]) }}">
                    口コミを編集
                </a>
                <form action="{{ route('assessment.destroy', ['id' => $review->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="link-button" onclick="return confirm('本当に削除しますか？')">口コミを削除</button>
                </form>
            </dev>
            <div class="review-info">
                <div class="review-evaluation">
                    <span class="star-rating">
                        @for ($i = 1; $i <= 5; $i++) @if ($i <=$review->evaluation)
                            <span class="star filled">&#9733;</span>
                            @else
                            <span class="star">&#9733;</span>
                            @endif
                            @endfor
                    </span>
                </div>
                <p class="review-comment">{{ $review->comment }}</p>
                @if ($review->image)
                <img src="{{ asset('images/' . $review->image) }}" alt="口コミ画像" class="review-image">
                @endif
            </div>
            @else
            <a href="{{ route('assessment.show', ['shop' => $shop->id]) }}">
                口コミを投稿する
            </a>
            @endif
        </div>
        <a href="#reserve-modal" class="reserve-button-mobile">予約</a>
    </div>
    <div class="shop-detail-right">
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="detail-body">
                <h3>予約</h3>
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <div class="reserve-date">
                    <input type="date" id="reserve_date" name="reserve_date" min="{{ $today }}">
                </div>
                <div class="reserve-time">
                    <select id="reserve_time" name="reserve_time" required>
                        <option value="" disabled {{ old('reserve_time') ? '' : 'selected' }}>予約時間を選択してください</option>
                        @for ($i = 0; $i < 24; $i++) <option value="{{ sprintf('%02d:00:00', $i) }}" {{ old('reserve_time') == sprintf('%02d:00:00', $i) ? 'selected' : '' }}>
                            {{ sprintf('%02d:00', $i) }}
                            </option>
                            <option value="{{ sprintf('%02d:30:00', $i) }}" {{ old('reserve_time') == sprintf('%02d:30:00', $i) ? 'selected' : '' }}>
                                {{ sprintf('%02d:30', $i) }}
                            </option>
                            @endfor
                    </select>
                </div>
                <div class="number-of-people">
                    <select id="number_of_people" name="number_of_people" required>
                        <option value="" disabled {{ old('number_of_people') ? '' : 'selected' }}>
                            予約人数を選択してください
                        </option>
                        @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}" {{ old('number_of_people') == $i ? 'selected' : '' }}>
                            {{ $i }}人
                            </option>
                            @endfor
                    </select>
                </div>
                <div class="reservation-summary">
                    <p>店名: {{ $shop->shop_name }}</p>
                    <p>日付: <span id="selected_date"></span></p>
                    <p>時間: <span id="selected_time"></span></p>
                    <p>人数: <span id="selected_people"></span></p>
                </div>
            </div>
            <button type="submit" class="reserve-button">予約する</button>
        </form>
    </div>
</main>

<div id="reviews-modal" class="reviews-modal">
    <div class="reviews-modal-content">
        <a href="#" class="reviews-modal-close">&times;</a>
        <h3>全ての口コミ情報</h3>
        @foreach ($allReviews as $allReview)
        <div class="review-item">
            <p>評価: {{ $allReview->evaluation }}</p>
            <p>コメント: {{ $allReview->comment }}</p>
            @if ($allReview->image)
            <img src="{{ asset('images/' . $allReview->image) }}" alt="口コミ画像" class="review-item-image">
            @endif
            @if ($isAdmin)
            <form action="{{ route('assessment.destroy', ['id' => $allReview->id]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('本当に削除しますか？')">口コミを削除</button>
            </form>
            @endif
        </div>
        @endforeach
    </div>
    <a href="#" class="reviews-modal-overlay"></a>
</div>

<div id="reserve-modal" class="shop-detail-modal">
    <div class="modal-content">
        <a href="#" class="modal-close">&times;</a>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="detail-body">
                <h3>予約</h3>
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <div class="modal-reserve-date">
                    <input type="date" id="modal_reserve_date" name="reserve_date" value="{{ old('reserve_date') }}" min="{{ $today }}">
                </div>
                <div class="modal-reserve-time">
                    <select id="modal_reserve_time" name="reserve_time" required>
                        <option value="" disabled {{ old('reserve_time') ? '' : 'selected' }}>
                            予約時間を選択してください
                        </option>
                        @for ($i = 0; $i < 24; $i++) <option value="{{ sprintf('%02d:00:00', $i) }}" {{ old('reserve_time') == sprintf('%02d:00:00', $i) ? 'selected' : '' }}>
                            {{ sprintf('%02d:00', $i) }}
                            </option>
                            <option value="{{ sprintf('%02d:30:00', $i) }}" {{ old('reserve_time') == sprintf('%02d:30:00', $i) ? 'selected' : '' }}>
                                {{ sprintf('%02d:30', $i) }}
                            </option>
                            @endfor
                    </select>
                </div>
                <div class="modal-number-of-people">
                    <select id="modal_number_of_people" name="number_of_people" required>
                        <option value="" disabled {{ old('number_of_people') ? '' : 'selected' }}>
                            予約人数を選択してください
                        </option>
                        @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}" {{ old('number_of_people') == $i ? 'selected' : '' }}>
                            {{ $i }}人
                            </option>
                            @endfor
                    </select>
                </div>
                <div class="modal-reservation-summary">
                    <p>店名: {{ $shop->shop_name }}</p>
                    <p>日付: <span id="selected_date_modal"></span></p>
                    <p>時間: <span id="selected_time_modal"></span></p>
                    <p>人数: <span id="selected_people_modal"></span></p>
                </div>
            </div>
            <button type="submit" class="reserve-button">予約する</button>
        </form>
    </div>
    <a href="#" class="modal-overlay"></a>
</div>

<script src="{{ asset('js/shop-detail.js') }}"></script>
@endsection