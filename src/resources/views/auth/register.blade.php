@extends('layouts.app')

@section('title', '会員登録')

@section('content')
        <h2>会員登録</h2>
        <form action="/register" method="POST">
            @csrf
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div>{{ $message }}</div>
                @enderror
            </div>
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
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit">登録</button>
        </form>
@endsection
