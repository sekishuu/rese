@extends('layouts.app')

@section('title', '予約チェックイン QRコード')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/generate-qr-code.css') }}">
@endsection

@section('content')
<div class="qr-code-container">
    <div class="qr-code-card">
        <h1 class="qr-code-title">予約チェックイン QRコード</h1>
        <div class="qr-code">
            {!! $qrCode !!}
        </div>
        <p class="qr-code-description">このQRコードをお店のスタッフに見せてください</p>
        <div class="qr-code-buttons">
            <a href="{{ $url }}" target="_blank" class="qr-code-button">リンクを開く(店舗スタッフ用)
            </a>
            <a href="{{ route('mypage') }}" class="qr-code-button">マイページに戻る</a>
        </div>
    </div>
</div>
@endsection
