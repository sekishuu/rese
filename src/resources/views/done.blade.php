@extends('layouts.app')

@section('title', '予約完了')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done-container">
    <div class="done-card">
        <h1 class="done-title">ご予約ありがとうございます</h1>
        <a href="/" class="done-button">戻る</a>
    </div>
</div>
@endsection
