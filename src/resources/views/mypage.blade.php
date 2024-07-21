@extends('layouts.app')

@section('title', 'マイページ')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<label for="modal-toggle-favorites" class="modal-toggle-favorites-button">お気に入り店舗一覧を表示</label>
<div class="mypage-container">
    <div class="reservation-visited-container">
        <div class="mypage-section">
            <h2>予約状況</h2>
            <div id="reservations">
                @foreach ($reservations as $index => $reservation)
                <div class="reservation-card">
                    <div class="reservation-header">
                        <p class="reservation-number">予約{{ $index + 1 }}</p>
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rsv-destroy-button">&times;</button>
                        </form>
                    </div>
                    <p>Shop &emsp;{{ $reservation->shop->shop_name }}</p>
                    <p>Date &emsp;{{ $reservation->reserve_date }}</p>
                    <p>Time &emsp;{{ $reservation->reserve_time }}</p>
                    <p>Number &emsp;{{ $reservation->number_of_people }}人</p>
                    <div class="edit-qrcode-container">
                        <div class="reserve-edit-button">
                            <a href="#modal-reserve-{{ $reservation->id }}" class="button">予約変更</a>
                        </div>
                        <div class="qrcode-button">
                            <a href="{{ route('reservations.qrcode', $reservation->id) }}" class="button">チェックインQRコードを表示</a>
                        </div>
                    </div>
                </div>
                <div class="mypage-modal" id="modal-reserve-{{ $reservation->id }}">
                    <a href="#!" class="mypage-modal-overlay"></a>
                    <div class="mypage-modal-content">
                        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mypage-modal-date">
                                <label for="reserve_date-{{ $reservation->id }}">日付</label>
                                <input type="date" id="reserve_date-{{ $reservation->id }}" name="reserve_date" value="{{ old('reserve_date', $reservation->reserve_date) }}" required>
                            </div>
                            <div class="mypage-modal-time">
                                <label for="reserve_time-{{ $reservation->id }}">時間</label>
                                <select id="reserve_time-{{ $reservation->id }}" name="reserve_time" required>
                                    @for ($i = 0; $i < 24; $i++)
                                        <option value="{{ sprintf('%02d:00:00', $i) }}" {{ old('reserve_time', $reservation->reserve_time) == sprintf('%02d:00:00', $i) ? 'selected' : '' }}>
                                            {{ sprintf('%02d:00', $i) }}
                                        </option>
                                        <option value="{{ sprintf('%02d:30:00', $i) }}" {{ old('reserve_time', $reservation->reserve_time) == sprintf('%02d:30:00', $i) ? 'selected' : '' }}>
                                            {{ sprintf('%02d:30', $i) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mypage-modal-people">
                                <label for="number_of_people-{{ $reservation->id }}">人数</label>
                                <select id="number_of_people-{{ $reservation->id }}" name="number_of_people" required>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('number_of_people', $reservation->number_of_people) == $i ? 'selected' : '' }}>
                                            {{ $i }}人
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <a href="#!" class="modal-close button">&times;</a>
                            <button type="submit">この内容で変更する</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="mypage-section">
            <h2>来店済み店舗</h2>
            <div id="past-reservations">
                @foreach ($pastReservations as $reservation)
                <div class="visited-card">
                    <p>店舗名: {{ $reservation->shop->shop_name }}</p>
                    <p>予約年月日: {{ $reservation->reserve_date }}</p>
                    <p>予約時間: {{ $reservation->reserve_time }}</p>
                    <p>予約人数: {{ $reservation->number_of_people }}人</p>
                    <div class="rating-container">
                        <p>評価: </p>
                        @if ($reservation->rating > 0)
                        <div class="star-rating" style="--rating: {{ $reservation->rating }};">
                            <span></span>
                        </div>
                        @else
                        <p>評価なし</p>
                        @endif
                    </div>
                    <div class="review-comment">
                        <p>コメント: {{ $reservation->review->comment ?? 'コメントなし' }}</p>
                    </div>
                    <div class="visited-buttons">
                        <a href="#modal-review-{{ $reservation->id }}" class="button">評価とコメントを編集</a>
                        <a href="{{ route('payments.show', $reservation->id) }}" class="button" style="float: right;">お支払い</a>
                    </div>
                </div>
                <div class="mypage-modal" id="modal-review-{{ $reservation->id }}">
                    <a href="#!" class="mypage-modal-overlay"></a>
                    <div class="mypage-review-modal-content">
                        @if ($reservation->review)
                        <form action="{{ route('reviews.update', $reservation->review->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="evaluation-{{ $reservation->id }}">評価</label>
                            <select id="evaluation-{{ $reservation->id }}" name="evaluation" required>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('evaluation', $reservation->review->evaluation) == $i ? 'selected' : '' }}>
                                        {{ str_repeat('★', $i) }}
                                    </option>
                                @endfor
                            </select>
                            <div class="review-label-text">
                                <label for="comment-{{ $reservation->id }}">コメント</label>
                                <textarea id="comment-{{ $reservation->id }}" name="comment" rows="4">{{ old('comment', $reservation->review->comment) }}</textarea>
                            </div>
                            <a href="#!" class="modal-close button">&times;</a>
                            <button type="submit">この内容で保存する</button>
                        </form>
                        @else
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
                            <label for="evaluation-{{ $reservation->id }}">評価</label>
                            <select id="evaluation-{{ $reservation->id }}" name="evaluation" required>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('evaluation') == $i ? 'selected' : '' }}>
                                        {{ str_repeat('★', $i) }}
                                    </option>
                                @endfor
                            </select>
                            <label for="comment-{{ $reservation->id }}">コメント</label>
                            <textarea id="comment-{{ $reservation->id }}" name="comment" rows="4">{{ old('comment') }}</textarea>
                            <a href="#!" class="modal-close button">キャンセル</a>
                            <button type="submit">この内容で保存する</button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mypage-section-favorites">
        <h2>お気に入り店舗</h2>
        <div id="bookmarks" class="bookmarks-grid">
            @foreach ($favorites as $favorite)
            <div class="favorites-card">
                <div class="image-container">
                    <img src="{{ asset('storage/shop_images/' . $favorite->shop->shop_image) }}" alt="{{ $favorite->shop->shop_name }}" class="shop-image">
                </div>
                <div class="title-container">
                    <h3>{{ $favorite->shop->shop_name }}</h3>
                </div>
                <div class="info-tags">
                    <p>#{{ $favorite->shop->area->area_name }} #{{ $favorite->shop->genre->genre_name }}</p>
                </div>
                <div class="info-shop-info">
                    <p>{{ $favorite->shop->shop_info }}</p>
                </div>
                <div class="link-container">
                    <a href="{{ route('shops.show', $favorite->shop->id) }}" class="detail-link">詳しくみる</a>
                    <button class="favorite-btn" data-shop-id="{{ $favorite->shop->id }}">
                        @if(Auth::check() && $favorite->shop->favorites->where('user_id', Auth::id())->isNotEmpty())
                        <span class="heart active">&#x2764;</span>
                        @else
                        <span class="heart">&#x2764;</span>
                        @endif
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<input type="checkbox" id="modal-toggle-favorites" class="modal-toggle-favorites-checkbox">
<div class="mypage-favorites-modal">
    <div class="mypage-favorites-modal-content">
        <div class="favorites-modal-header">
            <h2>お気に入り店舗</h2>
            <label for="modal-toggle-favorites" class="modal-close-favorites">&times;</label>
        </div>
        <div id="bookmarks-modal" class="bookmarks-grid-modal">
            @foreach ($favorites as $favorite)
            <div class="favorites-card-modal">
                <div class="image-container">
                    <img src="{{ asset('storage/shop_images/' . $favorite->shop->shop_image) }}" alt="{{ $favorite->shop->shop_name }}" class="shop-image">
                </div>
                <div class="title-container">
                    <h3>{{ $favorite->shop->shop_name }}</h3>
                </div>
                <div class="info-tags">
                    <p>#{{ $favorite->shop->area->area_name }} #{{ $favorite->shop->genre->genre_name }}</p>
                </div>
                <div class="info-shop-info">
                    <p>{{ $favorite->shop->shop_info }}</p>
                </div>
                <div class="link-container">
                    <a href="{{ route('shops.show', $favorite->shop->id) }}" class="detail-link">詳しくみる</a>
                    <button class="favorite-btn" data-shop-id="{{ $favorite->shop->id }}">
                        @if(Auth::check() && $favorite->shop->favorites->where('user_id', Auth::id())->isNotEmpty())
                        <span class="heart active">&#x2764;</span>
                        @else
                        <span class="heart">&#x2764;</span>
                        @endif
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection