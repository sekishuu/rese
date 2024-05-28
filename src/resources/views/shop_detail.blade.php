@extends('layouts.app')

@section('title', $shop->shop_name . ' - 詳細表示')

@section('content')
    <main style="display: flex; padding: 20px;">
        <div style="flex: 3; margin-right: 20px;">
            <h2>{{ $shop->shop_name }}</h2>
            <img src="{{ $shop->shop_image }}" alt="{{ $shop->shop_name }}" style="width: 300px; height: 300px;">
            <p>エリア: {{ $shop->area->area_name }}</p>
            <p>ジャンル: {{ $shop->genre->genre_name }}</p>
            <p>{{ $shop->shop_info }}</p>
        </div>
        <div style="flex: 1;">
            <h3>予約</h3>
            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <label for="reserve_date">日付</label>
                <input type="date" id="reserve_date" name="reserve_date" >
                @error('reserve_date')
                    <div>{{ $message }}</div>
                @enderror
                
                <label for="reserve_time">時間</label>
                <select id="reserve_time" name="reserve_time" required>
                    @for ($i = 0; $i < 24; $i++)
                        <option value="{{ sprintf('%02d:00:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                        <option value="{{ sprintf('%02d:30:00', $i) }}">{{ sprintf('%02d:30', $i) }}</option>
                    @endfor
                </select>
                @error('reserve_time')
                    <div>{{ $message }}</div>
                @enderror
                
                <label for="number_of_people">人数</label>
                <select id="number_of_people" name="number_of_people" required>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}人</option>
                    @endfor
                </select>
                @error('number_of_people')
                    <div>{{ $message }}</div>
                @enderror
                
                <div style="margin-top: 20px;">
                    <p>店名: {{ $shop->shop_name }}</p>
                    <p>日付: <span id="selected_date"></span></p>
                    <p>時間: <span id="selected_time"></span></p>
                    <p>人数: <span id="selected_people"></span></p>
                </div>
                
                <button type="submit">予約する</button>
            </form>
        </div>
    </main>
    <script src="{{ asset('js/shop_detail.js') }}"></script>
@endsection

