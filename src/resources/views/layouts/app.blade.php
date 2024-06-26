<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rese')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('styles')
</head>
<body>
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border-bottom: 1px solid #ccc;">
        <h1>Rese</h1>
        <div style="display: flex; align-items: center;">
            @auth
                <span>こんにちは、{{ Auth::user()->name }}さん！</span>
            @endauth
        </div>
        <nav>
            <ul style="display: flex; list-style: none; margin: 0; padding: 0;">
                <li style="margin-right: 10px;"><a href="{{ url('/') }}">Home</a></li>
                @auth
                    <li style="margin-right: 10px;"><a href="{{ route('mypage') }}">Mypage</a></li>
                    @if(Auth::user()->user_type == 'shop_owner')
                        <li style="margin-right: 10px;"><a href="{{ route('shop-owner.index') }}">Shop Owner Page</a></li>
                    @elseif(Auth::user()->user_type == 'admin')
                        <li style="margin-right: 10px;"><a href="{{ route('admin.index') }}">Admin Page</a></li>
                    @endif
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li style="margin-right: 10px;"><a href="{{ route('register') }}">Registration</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </nav>
    </header>
    <main style="padding: 20px;">
        @yield('content')
    </main>
    <script src="{{ asset('js/favorites.js') }}"></script>
</body>
</html>
