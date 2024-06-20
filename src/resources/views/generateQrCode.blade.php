@extends('layouts.app')

@section('title', '予約チェックイン QRコード')

@section('content')
    <div class="container">
        <h1>予約チェックイン QRコード</h1>
        <div class="qr-code">
            {!! $qrCode !!}
        </div>
        <p>このQRコードをお店のスタッフに見せてください</p>
        <a href="{{ $url }}" target="_blank" class="button">リンクを開く</a>
        <a href="{{ route('mypage') }}" class="button">マイページに戻る</a>
    </div>
@endsection