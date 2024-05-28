@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
        <h2>ログイン</h2>
        <form action="/login" method="POST">
            @csrf
            <div>
                <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div>{{ $message }}</div>
            @enderror
            </div>
            <div>
                <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div>{{ $message }}</div>
            @enderror
            </div>
            <button type="submit">ログイン</button>
        </form>
@endsection