<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $shop->shop_name }} - 詳細表示</title>
</head>
<body>
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border-bottom: 1px solid #ccc;">
        <h1>Rese</h1>
    </header>
    <main style="display: flex; padding: 20px;">
        <div style="flex: 3; margin-right: 20px;">
            <h2>{{ $shop->shop_name }}</h2>
            <img src="{{ $shop->shop_image }}" alt="{{ $shop->shop_name }}" style="width: 300px; height: 300px;">
            <p>エリア: {{ $shop->area->area_name }}</p>
            <p>ジャンル: {{ $shop->genre->genre_name }}</p>
            <p>{{ $shop->shop_info }}</p>
        </div>
        <div style="flex: 1;">
            <h3>予約</h3>
            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <label for="reserve_date">日付</label>
                <input type="date" id="reserve_date" name="reserve_date" >
                
                <label for="reserve_time">時間</label>
                <select id="reserve_time" name="reserve_time" required>
                    @for ($i = 0; $i < 24; $i++)
                        <option value="{{ sprintf('%02d:00:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                        <option value="{{ sprintf('%02d:30:00', $i) }}">{{ sprintf('%02d:30', $i) }}</option>
                    @endfor
                </select>
                
                <label for="number_of_people">人数</label>
                <select id="number_of_people" name="number_of_people" required>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}人</option>
                    @endfor
                </select>
                
                <div style="margin-top: 20px;">
                    <p>店名: {{ $shop->shop_name }}</p>
                    <p>日付: <span id="selected_date"></span></p>
                    <p>時間: <span id="selected_time"></span></p>
                    <p>人数: <span id="selected_people"></span></p>
                </div>
                
                <button type="submit">予約する</button>
            </form>
        </div>
    </main>
    <script>
        document.getElementById('reserve_date').addEventListener('change', function() {
            document.getElementById('selected_date').innerText = this.value;
        });

        document.getElementById('reserve_time').addEventListener('change', function() {
            document.getElementById('selected_time').innerText = this.value;
        });

        document.getElementById('number_of_people').addEventListener('change', function() {
            document.getElementById('selected_people').innerText = this.value;
        });
    </script>
</body>
</html>

