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
                    @error('reserve_date')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <div class="reserve-time">
                    <select id="reserve_time" name="reserve_time" required>
                        <option value="" disabled selected>予約時間を選択してください</option>
                        @for ($i = 0; $i < 24; $i++)
                            <option value="{{ sprintf('%02d:00:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                            <option value="{{ sprintf('%02d:30:00', $i) }}">{{ sprintf('%02d:30', $i) }}</option>
                        @endfor
                    </select>
                    @error('reserve_time')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <div class="number-of-people">
                    <select id="number_of_people" name="number_of_people" required>
                        <option value="" disabled selected>予約人数を選択してください</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}人</option>
                        @endfor
                    </select>
                    @error('number_of_people')
                        <div>{{ $message }}</div>
                    @enderror
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
<div id="reserve-modal" class="shop-detail-modal">
    <div class="modal-content">
        <a href="#" class="modal-close">&times;</a>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="detail-body">
                <h3>予約</h3>
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <div class="modal-reserve-date">
                    <input type="date" id="modal_reserve_date" name="reserve_date" min="{{ $today }}">
                    @error('reserve_date')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-reserve-time">
                    <select id="modal_reserve_time" name="reserve_time" required>
                        <option value="" disabled selected>予約時間を選択してください</option>
                        @for ($i = 0; $i < 24; $i++)
                            <option value="{{ sprintf('%02d:00:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                            <option value="{{ sprintf('%02d:30:00', $i) }}">{{ sprintf('%02d:30', $i) }}</option>
                        @endfor
                    </select>
                    @error('reserve_time')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-number-of-people">
                    <select id="modal_number_of_people" name="number_of_people" required>
                        <option value="" disabled selected>予約人数を選択してください</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}人</option>
                        @endfor
                    </select>
                    @error('number_of_people')
                        <div>{{ $message }}</div>
                    @enderror
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


