@extends('layouts.app')

@section('title', 'マイページ')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: flex;">
        <div style="flex: 1; margin-right: 20px;">
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
                        
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">削除</button>
                        </form>
                        <!-- 予約変更ボタン -->
                        <a href="#modal-{{ $reservation->id }}" class="button">予約変更</a>
                        <br>
                        <a href="{{ route('reservations.qrcode', $reservation->id) }}" class="button">チェックインQRコードを表示</a>
                    </div>
                    <!-- モーダルウィンドウ -->
                    <div class="modal" id="modal-{{ $reservation->id }}">
                        <a href="#!" class="modal-overlay"></a>
                        <div class="modal-content">
                            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label for="reserve_date-{{ $reservation->id }}">日付</label>
                                <input type="date" id="reserve_date-{{ $reservation->id }}" name="reserve_date" value="{{ $reservation->reserve_date }}" required>

                                <label for="reserve_time-{{ $reservation->id }}">時間</label>
                                <select id="reserve_time-{{ $reservation->id }}" name="reserve_time" required>
                                    @for ($i = 0; $i < 24; $i++)
                                        <option value="{{ sprintf('%02d:00:00', $i) }}" @if($reservation->reserve_time == sprintf('%02d:00:00', $i)) selected @endif>{{ sprintf('%02d:00', $i) }}</option>
                                        <option value="{{ sprintf('%02d:30:00', $i) }}" @if($reservation->reserve_time == sprintf('%02d:30:00', $i)) selected @endif>{{ sprintf('%02d:30', $i) }}</option>
                                    @endfor
                                </select>

                                <label for="number_of_people-{{ $reservation->id }}">人数</label>
                                <select id="number_of_people-{{ $reservation->id }}" name="number_of_people" required>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" @if($reservation->number_of_people == $i) selected @endif>{{ $i }}人</option>
                                    @endfor
                                </select>

                                <div style="margin-top: 20px;">
                                    <a href="#!" class="modal-close button">キャンセル</a>
                                    <button type="submit">この内容で変更する</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div style="flex: 1; margin-right: 20px;">
            <h2>来店済み店舗</h2>
            <div id="past-reservations">
                <!-- 来店済み店舗情報の表示 -->
                @foreach ($pastReservations as $reservation)
                    @php
                        $review = $reviews->get($reservation->shop_id);
                        $rating = $review ? $review->evaluation : 0;
                    @endphp
                    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                        <p>店舗名: {{ $reservation->shop->shop_name }}</p>
                        <p>予約年月日: {{ $reservation->reserve_date }}</p>
                        <p>予約時間: {{ $reservation->reserve_time }}</p>
                        <p>予約人数: {{ $reservation->number_of_people }}人</p>
                        <p>評価: 
                            @if ($rating > 0)
                                <div class="star-rating" style="--rating: {{ $rating }};">
                                    <span></span>
                                </div>
                            @else
                                評価なし
                            @endif
                        </p>
                        <p>コメント: {{ $review->comment ?? 'コメントなし' }}</p>
                        <a href="#modal-review-{{ $reservation->id }}" class="button">評価とコメントを編集</a>
                    </div>
                    <!-- モーダルウィンドウ -->
                    <div class="modal" id="modal-review-{{ $reservation->id }}">
                        <a href="#!" class="modal-overlay"></a>
                        <div class="modal-content">
                            @if ($review)
                                <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="evaluation-{{ $reservation->id }}">評価</label>
                                    <select id="evaluation-{{ $reservation->id }}" name="evaluation" required>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" @if($review->evaluation == $i) selected @endif>{{ str_repeat('★', $i) }}</option>
                                        @endfor
                                    </select>

                                    <label for="comment-{{ $reservation->id }}">コメント</label>
                                    <textarea id="comment-{{ $reservation->id }}" name="comment" rows="4">{{ $review->comment }}</textarea>

                                    <div style="margin-top: 20px;">
                                        <a href="#!" class="modal-close button">キャンセル</a>
                                        <button type="submit">この内容で保存する</button>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
                                    <label for="evaluation-{{ $reservation->id }}">評価</label>
                                    <select id="evaluation-{{ $reservation->id }}" name="evaluation" required>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ str_repeat('★', $i) }}</option>
                                        @endfor
                                    </select>

                                    <label for="comment-{{ $reservation->id }}">コメント</label>
                                    <textarea id="comment-{{ $reservation->id }}" name="comment" rows="4"></textarea>

                                    <div style="margin-top: 20px;">
                                        <a href="#!" class="modal-close button">キャンセル</a>
                                        <button type="submit">この内容で保存する</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div style="flex: 1;">
            <h2>お気に入り店舗</h2>
            <div id="bookmarks">
                <!-- ブックマークした店舗情報の表示 -->
                @foreach ($favorites as $favorite)
                    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                        <img src="{{ asset('storage/shop_images/' . $favorite->shop->shop_image) }}" alt="{{ $favorite->shop->shop_name }}" style="width: 100px; height: 100px;">
                        <h3>{{ $favorite->shop->shop_name }}</h3>
                        <p>エリア: {{ $favorite->shop->area->area_name }}</p>
                        <p>ジャンル: {{ $favorite->shop->genre->genre_name }}</p>
                        <p>{{ $favorite->shop->shop_info }}</p>
                        <a href="{{ route('shops.show', $favorite->shop->id) }}">詳細表示</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
