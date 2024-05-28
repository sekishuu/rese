<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rese')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
