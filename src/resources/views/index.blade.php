<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>飲食店一覧</title>
</head>
<body>
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border-bottom: 1px solid #ccc;">
        <h1>飲食店一覧</h1>
        <div style="display: flex; align-items: center;">
            @auth
                <span>こんにちは、{{ Auth::user()->name }}さん！</span>
                <form action="{{ route('logout') }}" method="POST" style="margin-left: 10px;">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}" style="margin-left: 10px;">ログイン</a>
                <a href="{{ route('register') }}" style="margin-left: 10px;">会員登録</a>
            @endguest
        </div>
        <form action="/" method="GET" style="display: flex; align-items: center;">
            <select name="area" style="margin-right: 10px;">
                <option value="">エリアを選択</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                @endforeach
            </select>
            <select name="genre" style="margin-right: 10px;">
                <option value="">ジャンルを選択</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                @endforeach
            </select>
            <input type="text" name="keyword" placeholder="キーワード検索" style="margin-right: 10px;">
            <button type="submit">検索</button>
        </form>
    </header>
    <main style="padding: 20px;">
        <div class="shop-list">
            <!-- 飲食店舗のリストをここに表示 -->
            @foreach ($shops as $shop)
                <div class="shop-item" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                    <img src="{{ $shop->shop_image }}" alt="{{ $shop->shop_name }}" style="width: 100px; height: 100px;">
                    <h2>{{ $shop->shop_name }}</h2>
                    <p>エリア: {{ $shop->area->area_name }}</p>
                    <p>ジャンル: {{ $shop->genre->genre_name }}</p>
                    <a href="{{ route('shops.show', $shop->id) }}">詳細表示</a>
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>


