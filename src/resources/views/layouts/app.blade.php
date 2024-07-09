<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rese')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <header class="header">
        <div class="logo-container">
            <div class="menu-button-container">
                <label for="menu-toggle" class="cp_hmenuac03" id="menu-button">
                    <span class="cp_bar"></span>
                </label>
            </div>
            <h1>Rese</h1>
            @auth
            <span class="greeting">
                {{ Auth::user()->name }}さん
                @if (Auth::user()->user_type == 'shop_owner')
                【店舗代表者】
                @elseif (Auth::user()->user_type == 'admin')
                【管理者】
                @endif
            </span>
            @endauth
        </div>
    </header>
    <main class="main-content">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>【エラー】{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @yield('content')
    </main>
    <div class="modal">
        <div class="modal-content">
            <nav class="modal-nav">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    @auth
                    <li><a href="{{ route('mypage') }}">Mypage</a></li>
                    @if(Auth::user()->user_type == 'shop_owner')
                    <li><a href="{{ route('shop-owner.index') }}">Shop Owner Page</a></li>
                    @elseif(Auth::user()->user_type == 'admin')
                    <li><a href="{{ route('admin.index') }}">Admin Page</a></li>
                    @endif
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @else
                    <li><a href="{{ route('register') }}">Registration</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </div>
    <script src="{{ asset('js/favorites.js') }}"></script>
</body>

</html>