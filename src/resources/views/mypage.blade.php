<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ - Rese</title>
</head>
<body>
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border-bottom: 1px solid #ccc;">
        <h1>Rese</h1>
    </header>
    <main style="display: flex; padding: 20px;">
        <div style="flex: 2; margin-right: 20px;">
            <h2>予約状況</h2>
            <div id="reservations">
                <!-- 予約情報の表示 -->
                @foreach ($reservations as $index => $reservation)
                    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                        <p>予約{{ $index + 1 }}</p>
                        <p>店舗名: {{ $reservation->shop->shop_name }}</p>
                        <p>予約年月日: {{ $reservation->reserve_date }}</p>
                        <p>予約時間: {{ $reservation->reserve_time }}</p>
                        <p>予約人数: {{ $reservation->number_of_people }}人</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div style="flex: 1;">
            <h2>ブックマークした店舗</h2>
            <div id="bookmarks">
                <!-- ブックマークした店舗情報の表示 -->
                @foreach ($favorites as $favorite)
                    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                        <img src="{{ $favorite->shop->shop_image }}" alt="{{ $favorite->shop->shop_name }}" style="width: 100px; height: 100px;">
                        <h3>{{ $favorite->shop->shop_name }}</h3>
                        <p>エリア: {{ $favorite->shop->area->area_name }}</p>
                        <p>ジャンル: {{ $favorite->shop->genre->genre_name }}</p>
                        <p>{{ $favorite->shop->shop_info }}</p>
                        <a href="{{ route('shops.show', $favorite->shop->id) }}">詳細表示</a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</body>
</html>
