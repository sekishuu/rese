@extends('layouts.app')

@section('title', '管理者ページ')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-container">
    <h1>管理者ページ</h1>
    <div class="tabs">
        <input type="radio" id="tab1" name="tab-control" checked>
        <input type="radio" id="tab2" name="tab-control">
        <input type="radio" id="tab3" name="tab-control">
        <input type="radio" id="tab4" name="tab-control">
        <ul>
            <li title="ユーザー"><label for="tab1" role="button"><span>ユーザー</span></label></li>
            <li title="店舗"><label for="tab2" role="button"><span>店舗</span></label></li>
            <li title="エリア"><label for="tab3" role="button"><span>エリア</span></label></li>
            <li title="ジャンル"><label for="tab4" role="button"><span>ジャンル</span></label></li>
        </ul>
        <div class="slider"><div class="indicator"></div></div>
        <div class="content">
            <section id="content1">
                <div class="section-header">
                    <h2>ユーザー</h2>
                    <a href="#modal-add-user" class="button">＋新規追加</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->user_type }}</td>
                            <td>
                                <a href="#modal-edit-user-{{ $user->id }}" class="button">編集</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                        <!-- ユーザー編集モーダル -->
                        <div class="modal" id="modal-edit-user-{{ $user->id }}">
                            <a href="#" class="modal-overlay"></a>
                            <div class="modal-content">
                                <form action="{{ route('users.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" value="{{ $user->name }}" required>

                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" value="{{ $user->email }}" required>

                                    <label for="user_type">User Type</label>
                                    <select id="user_type" name="user_type" required>
                                        <option value="general" {{ $user->user_type == 'general' ? 'selected' : '' }}>General</option>
                                        <option value="shop_owner" {{ $user->user_type == 'shop_owner' ? 'selected' : '' }}>Shop Owner</option>
                                        <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>

                                    <div style="margin-top: 20px;">
                                        <a href="#" class="modal-close button">キャンセル</a>
                                        <button type="submit">この内容で変更する</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                <!-- ユーザー新規追加モーダル -->
                <div class="modal" id="modal-add-user">
                    <a href="#" class="modal-overlay"></a>
                    <div class="modal-content">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>

                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>

                            <label for="user_type">User Type</label>
                            <select id="user_type" name="user_type" required>
                                <option value="general">General</option>
                                <option value="shop_owner">Shop Owner</option>
                                <option value="admin">Admin</option>
                            </select>

                            <div style="margin-top: 20px;">
                                <a href="#" class="modal-close button">キャンセル</a>
                                <button type="submit">この内容で新規登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section id="content2">
                <div class="section-header">
                    <h2>店舗</h2>
                    <a href="#modal-add-shop" class="button">＋新規追加</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Shop Name</th>
                            <th>Area</th>
                            <th>Genre</th>
                            <th>User</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shops as $shop)
                        <tr>
                            <td>{{ $shop->id }}</td>
                            <td>{{ $shop->shop_name }}</td>
                            <td>{{ $shop->area->area_name }}</td>
                            <td>{{ $shop->genre->genre_name }}</td>
                            <td>{{ $shop->user ? $shop->user->name : 'N/A' }}</td>
                            <td>
                                <a href="#modal-edit-shop-{{ $shop->id }}" class="button">編集</a>
                                <form action="{{ route('admin-shops.destroy', $shop->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                        <!-- 店舗編集モーダル -->
                        <div class="modal" id="modal-edit-shop-{{ $shop->id }}">
                            <a href="#" class="modal-overlay"></a>
                            <div class="modal-content">
                                <form action="{{ route('admin-shops.update', $shop->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="shop_name">Shop Name</label>
                                    <input type="text" id="shop_name" name="shop_name" value="{{ $shop->shop_name }}" required>

                                    <label for="area_id">Area</label>
                                    <select id="area_id" name="area_id" required>
                                        @foreach ($areas as $area)
                                        <option value="{{ $area->id }}" {{ $shop->area_id == $area->id ? 'selected' : '' }}>{{ $area->area_name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="genre_id">Genre</label>
                                    <select id="genre_id" name="genre_id" required>
                                        @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}" {{ $shop->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->genre_name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="user_id">User</label>
                                    <select id="user_id" name="user_id" required>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $shop->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    <div style="margin-top: 20px;">
                                        <a href="#" class="modal-close button">キャンセル</a>
                                        <button type="submit">この内容で変更する</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                <!-- 店舗新規追加モーダル -->
                <div class="modal" id="modal-add-shop">
                    <a href="#" class="modal-overlay"></a>
                    <div class="modal-content">
                        <form action="{{ route('admin.shops.store') }}" method="POST">
                            @csrf
                            <label for="shop_name">Shop Name</label>
                            <input type="text" id="shop_name" name="shop_name" required>

                            <label for="area_id">Area</label>
                            <select id="area_id" name="area_id" required>
                                @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                @endforeach
                            </select>

                            <label for="genre_id">Genre</label>
                            <select id="genre_id" name="genre_id" required>
                                @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                                @endforeach
                            </select>

                            <label for="user_id">User</label>
                            <select id="user_id" name="user_id" required>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>

                            <div style="margin-top: 20px;">
                                <a href="#" class="modal-close button">キャンセル</a>
                                <button type="submit">この内容で新規登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section id="content3">
                <div class="section-header">
                    <h2>エリア</h2>
                    <a href="#modal-add-area" class="button">＋新規追加</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Area Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areas as $area)
                        <tr>
                            <td>{{ $area->id }}</td>
                            <td>{{ $area->area_name }}</td>
                            <td>
                                <a href="#modal-edit-area-{{ $area->id }}" class="button">編集</a>
                                <form action="{{ route('areas.destroy', $area->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                        <!-- エリア編集モーダル -->
                        <div class="modal" id="modal-edit-area-{{ $area->id }}">
                            <a href="#" class="modal-overlay"></a>
                            <div class="modal-content">
                                <form action="{{ route('areas.update', $area->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="area_name">Area Name</label>
                                    <select id="area_name" name="area_name" required>
                                        @foreach ($areas as $a)
                                        <option value="{{ $a->id }}" {{ $area->id == $a->id ? 'selected' : '' }}>{{ $a->area_name }}</option>
                                        @endforeach
                                    </select>

                                    <div style="margin-top: 20px;">
                                        <a href="#" class="modal-close button">キャンセル</a>
                                        <button type="submit">この内容で変更する</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                <!-- エリア新規追加モーダル -->
                <div class="modal" id="modal-add-area">
                    <a href="#" class="modal-overlay"></a>
                    <div class="modal-content">
                        <form action="{{ route('areas.store') }}" method="POST">
                            @csrf
                            <label for="area_name">Area Name</label>
                            <input type="text" id="area_name" name="area_name" required>

                            <div style="margin-top: 20px;">
                                <a href="#" class="modal-close button">キャンセル</a>
                                <button type="submit">この内容で新規登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section id="content4">
                <div class="section-header">
                    <h2>ジャンル</h2>
                    <a href="#modal-add-genre" class="button">＋新規追加</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Genre Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($genres as $genre)
                        <tr>
                            <td>{{ $genre->id }}</td>
                            <td>{{ $genre->genre_name }}</td>
                            <td>
                                <a href="#modal-edit-genre-{{ $genre->id }}" class="button">編集</a>
                                <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                        <!-- ジャンル編集モーダル -->
                        <div class="modal" id="modal-edit-genre-{{ $genre->id }}">
                            <a href="#" class="modal-overlay"></a>
                            <div class="modal-content">
                                <form action="{{ route('genres.update', $genre->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="genre_name">Genre Name</label>
                                    <select id="genre_name" name="genre_name" required>
                                        @foreach ($genres as $g)
                                        <option value="{{ $g->id }}" {{ $genre->id == $g->id ? 'selected' : '' }}>{{ $g->genre_name }}</option>
                                        @endforeach
                                    </select>

                                    <div style="margin-top: 20px;">
                                        <a href="#" class="modal-close button">キャンセル</a>
                                        <button type="submit">この内容で変更する</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                <!-- ジャンル新規追加モーダル -->
                <div class="modal" id="modal-add-genre">
                    <a href="#" class="modal-overlay"></a>
                    <div class="modal-content">
                        <form action="{{ route('genres.store') }}" method="POST">
                            @csrf
                            <label for="genre_name">Genre Name</label>
                            <input type="text" id="genre_name" name="genre_name" required>

                            <div style="margin-top: 20px;">
                                <a href="#" class="modal-close button">キャンセル</a>
                                <button type="submit">この内容で新規登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
