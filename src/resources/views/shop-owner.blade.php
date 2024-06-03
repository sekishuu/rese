@extends('layouts.app')

@section('title', '店舗代表者ページ')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/shop-owner.css') }}">
@endsection

@section('content')
    <div class="shop-owner-container">
        <h1>店舗代表者ページ</h1>
        <div class="content">
            <div class="registered-shops">
                <h2>登録店舗情報</h2>
                @foreach ($shops as $shop)
                    <div class="shop-info">
                        <img src="{{ $shop->shop_image }}" alt="{{ $shop->shop_name }}" class="shop-image">
                        <h3>{{ $shop->shop_name }}</h3>
                        <p>エリア: {{ $shop->area->area_name }}</p>
                        <p>ジャンル: {{ $shop->genre->genre_name }}</p>
                        <p>{{ $shop->shop_info }}</p>
                        <div class="shop-actions">
                            <button>キャンセル</button>
                            <button>編集</button>
                            <button>削除</button>
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
                        <p>予約時間: {{ $reservation->reserve_time }}</p>
                        <p>予約人数: {{ $reservation->number_of_people }}人</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
