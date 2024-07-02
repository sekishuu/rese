@extends('layouts.app')

@section('title', '予約チェックイン')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/checkin.css') }}">
@endsection

@section('content')
    <div class="checkin-container">
        <h1>予約チェックイン</h1>
        <div class="reservation-details">
            <p><strong>予約ID:</strong> {{ $reservation->id }}</p>
            <p><strong>ユーザー:</strong> {{ $reservation->user->name }}</p>
            <p><strong>店舗:</strong> {{ $reservation->shop->shop_name }}</p>
            <p><strong>予約年月日:</strong> {{ $reservation->reserve_date }}</p>
            <p><strong>予約時間:</strong> {{ $reservation->reserve_time }}</p>
            <p><strong>予約人数:</strong> {{ $reservation->number_of_people }}</p>
            <p><strong>来店状況:</strong> {{ $reservation->visit ? '来店済み' : '未訪問' }}</p>

            <label for="modal-toggle" class="checkin-button">来店状況ステータスの変更</label>
            <input type="checkbox" id="modal-toggle" class="checkin-modal-checkbox">
            <div class="checkin-modal">
                <div class="checkin-modal-content">
                    <label for="modal-toggle" class="checkin-modal-close-button">&times;</label>
                    <form action="{{ route('reservations.updateVisit', $reservation->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="visit-status">来店状況</label>
                        <select id="visit-status" name="visit">
                            <option value="0" {{ !$reservation->visit ? 'selected' : '' }}>未訪問</option>
                            <option value="1" {{ $reservation->visit ? 'selected' : '' }}>来店済み</option>
                        </select>

                        <div style="margin-top: 2vw;">
                            <button type="submit" class="button">この内容で変更</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
