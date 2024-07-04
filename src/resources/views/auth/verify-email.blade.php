@extends('layouts.app')

@section('title', 'メールアドレスの確認')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
    <div class="verify-email-container">
        <h2>メールアドレスの確認</h2>
        <p>ご登録いただいたメールアドレスに確認メールを送信しました。メール内のリンクをクリックして認証を完了してください。</p>
        @if (session('message'))
            <div class="message">{{ session('message') }}</div>
        @endif
        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button type="submit" class="resend-button">確認メールを再送する</button>
        </form>
    </div>
@endsection