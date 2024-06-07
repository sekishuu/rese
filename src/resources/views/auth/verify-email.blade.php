@extends('layouts.app')

@section('title', 'メールアドレスの確認')

@section('content')
    <div>
        <h2>メールアドレスの確認</h2>
        <p>ご登録いただいたメールアドレスに確認メールを送信しました。メール内のリンクをクリックして認証を完了してください。</p>
        @if (session('message'))
            <div>{{ session('message') }}</div>
        @endif
        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button type="submit">確認メールを再送する</button>
        </form>
    </div>
@endsection
