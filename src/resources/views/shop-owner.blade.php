@extends('layouts.app')

@section('title', '店舗代表者ページ')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/shop-owner.css') }}">
@endsection

@section('content')
<div class="shop-owner-container">
    <h1 class="shop-owner-page-title">店舗代表者ページ</h1>
    <div class="shop-owner-content">
        <div class="registered-shops">
            <div class="shop-owner-section-header-shops">
                <h2 class="shop-owner-section-title">登録店舗情報</h2>
                <a href="#modal-add-shop" class="shop-owner-button-create">＋新規追加</a>
            </div>
            <div class="shop-owner-cards">
                @foreach ($shops as $shop)
                <div class="shop-owner-card">
                    <div class="shop-owner-image-container">
                        <img src="{{ asset('storage/shop_images/' . $shop->shop_image) }}" alt="{{ $shop->shop_name }}" class="shop-owner-shop-image">
                    </div>
                    <div class="shop-owner-title-container">
                        <h3>{{ $shop->shop_name }}</h3>
                    </div>
                    <div class="shop-owner-info-tags">
                        <p>#{{ $shop->area->area_name }}   #{{ $shop->genre->genre_name }}</p>
                    </div>    
                    <div class="shop-owner-info-shop-info">
                        <p>{{ $shop->shop_info }}</p>
                    </div>
                    <div class="shop-owner-link-container">
                        <a href="#modal-edit-shop-{{ $shop->id }}" class="shop-owner-button">編集</a>
                        @if($shop->stripe_account_id)
                            <a href="{{ route('stripe.accountLogin', ['shop' => $shop->id]) }}" class="shop-owner-button">Stripeログイン</a>
                        @else
                            <a href="{{ route('stripe.createLink', ['shop' => $shop->id]) }}" class="shop-owner-button">Stripeアカウント作成</a>
                        @endif
                        <form action="{{ route('shop-owner.shops.destroy', $shop->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="shop-owner-button">削除</button>
                        </form>
                    </div>
                </div>
                <div class="shop-owner-modal" id="modal-edit-shop-{{ $shop->id }}">
                    <a href="#" class="shop-owner-modal-overlay"></a>
                    <div class="shop-owner-modal-content">
                        <form action="{{ route('shop-owner.shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label for="shop_name">店舗名</label>
                            <input type="text" id="shop_name" name="shop_name" value="{{ $shop->shop_name }}" required>
                            <label for="shop_info">店舗情報</label>
                            <textarea id="shop_info" name="shop_info" required>{{ $shop->shop_info }}</textarea>
                            <label for="area_id">エリア</label>
                            <select id="area_id" name="area_id" required>
                                @foreach ($areas as $area)
                                <option value="{{ $area->id }}" {{ $shop->area_id == $area->id ? 'selected' : '' }}>{{ $area->area_name }}</option>
                                @endforeach
                            </select>
                            <label for="genre_id">ジャンル</label>
                            <select id="genre_id" name="genre_id" required>
                                @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ $shop->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->genre_name }}</option>
                                @endforeach
                            </select>
                            <label for="shop_image">画像を選択</label>
                            <input type="file" id="shop_image" name="shop_image">
                            <a href="#" class="shop-owner-modal-close shop-owner-button">キャンセル</a>
                            <button type="submit" class="shop-owner-button">この内容で更新する</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="shop-owner-reservations">
            <div class="shop-owner-section-header-reservation">
                <h2 class="shop-owner-section-title">予約情報</h2>
                <a href="#modal-send-notification" class="shop-owner-button">お知らせメール作成</a>
            </div>
            @foreach ($reservations as $reservation)  
                <div class="shop-owner-reservation-info">
                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="rsv-destroy-btn">&times;</button>
                    </form>
                    <p>店舗名: {{ $reservation->shop->shop_name }}</p>
                    <p>予約者名: {{ $reservation->user->name }}</p>
                    <p>予約年月日: {{ $reservation->reserve_date }}</p>
                    <p>予約時間: {{ $reservation->formatted_reserve_time }}</p>
                    <p>予約人数: {{ $reservation->number_of_people }}人</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="shop-owner-modal" id="modal-add-shop">
    <a href="#" class="shop-owner-modal-overlay"></a>
    <div class="shop-owner-modal-content">
        <form action="{{ route('shop-owner.shops.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="shop_name">店舗名</label>
            <input type="text" id="shop_name" name="shop_name" required>
            <label for="shop_info">店舗情報</label>
            <textarea id="shop_info" name="shop_info" required></textarea>
            <label for="area_id">エリア</label>
            <select id="area_id" name="area_id" required>
                @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                @endforeach
            </select>
            <label for="genre_id">ジャンル</label>
            <select id="genre_id" name="genre_id" required>
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                @endforeach
            </select>
            <label for="shop_image">画像を選択</label>
            <input type="file" id="shop_image" name="shop_image">
            <a href="#" class="shop-owner-modal-close shop-owner-button">キャンセル</a>
            <button type="submit" class="shop-owner-button">この内容で新規登録する</button>
        </form>
    </div>
</div>
<div class="shop-owner-modal" id="modal-send-notification">
    <a href="#" class="shop-owner-modal-overlay"></a>
    <div class="shop-owner-modal-content">
        <form action="{{ route('shop-owner.send-notification') }}" method="POST">
            @csrf
            <label for="recipients">送信先</label>
            @foreach ($reservations as $reservation)
            <div class="send-notification-user">
                <input type="checkbox" id="recipient-{{ $reservation->user->id }}" name="recipients[]" value="{{ $reservation->user->id }}">
                <label for="recipient-{{ $reservation->user->id }}">{{ $reservation->user->name }}</label>
            </div>
            @endforeach
            <label for="subject">メールタイトル</label>
            <input type="text" class="shop-owner-modal-mail-title" id="subject" name="subject" required>
            <label for="body">メール本文</label>
            <textarea id="body" name="body" required></textarea>
            <a href="#" class="shop-owner-modal-close shop-owner-button">キャンセル</a>
            <button type="submit" class="shop-owner-button">送信</button>
        </form>
    </div>
</div>
@endsection
