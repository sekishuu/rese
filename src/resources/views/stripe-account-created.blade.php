@extends('layouts.app')

@section('title', 'Stripe Account Created')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/stripe-account-created.css') }}">
@endsection

@section('content')
    <div class="stripe-account-container">
        <div class="stripe-account-card">
            <h1 class="stripe-account-title">Stripe Account Created</h1>
            <p class="stripe-account-message">Stripeアカウントが無事に作成されました。</p>
            <a href="{{ route('shop-owner.index') }}" class="stripe-account-button">店舗代表者ページに戻る</a>
        </div>
    </div>
@endsection