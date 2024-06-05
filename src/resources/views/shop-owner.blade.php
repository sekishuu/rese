@extends('layouts.app')

@section('title', '店舗代表者ページ')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/shop-owner.css') }}">
@endsection

@php
use Carbon\Carbon;
@endphp

@section('content')
<div class="shop-owner-container">
    <h1>店舗代表者ページ</h1>
    <div class="content">
        <div class="registered-shops">
            <div class="section-header">
                <h2>登録店舗情報</h2>
                <a href="#modal-add-shop" class="button">＋新規追加</a>
            </div>
            @foreach ($shops as $shop)
                <div class="shop-info">
                    <img src="{{ $shop->shop_image }}" alt="{{ $shop->shop_name }}" class="shop-image">
                    <h3>{{ $shop->shop_name }}</h3>
                    <p>エリア: {{ $shop->area->area_name }}</p>
                    <p>ジャンル: {{ $shop->genre->genre_name }}</p>
                    <p>{{ $shop->shop_info }}</p>
                    <div class="shop-actions">
                        <a href="#modal-edit-shop-{{ $shop->id }}" class="button">編集</a>
                        <form action="{{ route('shop-owner.shops.destroy', $shop->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button">削除</button>
                        </form>
                    </div>
                </div>

                <!-- 店舗編集モーダル -->
                <div class="modal" id="modal-edit-shop-{{ $shop->id }}">
                    <a href="#" class="modal-overlay"></a>
                    <div class="modal-content">
                        <form action="{{ route('shop-owner.shops.update', $shop->id) }}" method="POST">
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

                            <div style="margin-top: 20px;">
                                <a href="#" class="modal-close button">キャンセル</a>
                                <button type="submit">この内容で更新する</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="reservations">
            <h2>予約情報</h2>
            @foreach ($reservations as $reservation)
                <div class="reservation-info">
                    <p>店舗名: {{ $reservation->shop->shop_name }}</p>
                    <p>予約者名: {{ $reservation->user->name }}</p>
                    <p>予約年月日: {{ $reservation->reserve_date }}</p>
                    <p>予約時間: {{ Carbon::parse($reservation->reserve_time)->format('H:i') }}</p>
                    <p>予約人数: {{ $reservation->number_of_people }}人</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- 店舗新規追加モーダル -->
<div class="modal" id="modal-add-shop">
    <a href="#" class="modal-overlay"></a>
    <div class="modal-content">
        <form action="{{ route('shop-owner.shops.store') }}" method="POST">
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

            <div style="margin-top: 20px;">
                <a href="#" class="modal-close button">キャンセル</a>
                <button type="submit">この内容で新規登録する</button>
            </div>
        </form>
    </div>
</div>
@endsection
