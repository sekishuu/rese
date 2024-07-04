@extends('layouts.app')

@section('title', 'Create Stripe Account Link')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/create-stripe-account-link.css') }}">
@endsection

@section('content')
<div class="stripe-container">
    <div class="stripe-card">
        <h1 class="stripe-title">Create Stripe Account Link</h1>
        <p class="stripe-description">Stripeアカウントを作成するには、以下のリンクをクリックしてください。</p>
        <a href="{{ $accountLink }}" class="stripe-button">Stripeアカウント作成</a>
    </div>
</div>
@endsection