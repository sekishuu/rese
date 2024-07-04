@extends('layouts.app')

@section('title', '会員登録完了 - Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="thanks-container">
        <div class="thanks-card">
            <h2>会員登録ありがとうございます</h2>
            <h3>メール認証が完了しました。ログインしてください。</h3>
            <a href="/" class="login-button">ログインする</a>
        </div>
    </div>
@endsection