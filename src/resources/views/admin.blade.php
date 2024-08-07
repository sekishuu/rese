@extends('layouts.app')

@section('title', '管理者ページ')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-container">
    <h1 class="admin-page-title">管理者ページ</h1>
    <div class="admin-tabs">
        <input type="radio" id="admin-tab1" name="admin-tab-control" checked>
        <input type="radio" id="admin-tab2" name="admin-tab-control">
        <input type="radio" id="admin-tab3" name="admin-tab-control">
        <input type="radio" id="admin-tab4" name="admin-tab-control">
        <ul class="admin-tab-list">
            <li title="ユーザー">
                <label for="admin-tab1" role="button">
                    <span>ユーザー</span>
                </label>
            </li>
            <li title="店舗">
                <label for="admin-tab2" role="button">
                    <span>店舗</span>
                </label>
            </li>
            <li title="エリア">
                <label for="admin-tab3" role="button">
                    <span>エリア</span>
                </label>
            </li>
            <li title="ジャンル">
                <label for="admin-tab4" role="button">
                    <span>ジャンル</span>
                </label>
            </li>
        </ul>
        <div class="admin-slider"></div>
        <div class="admin-content">
            <section id="admin-content1">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">ユーザー</h2>
                    <a href="#admin-modal-add-user" class="admin-button admin-button-create">＋新規追加</a>
                </div>
                <div class="admin-table-container">
                    <table class="admin-table">
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
                                    <a href="#admin-modal-edit-user-{{ $user->id }}" class="admin-button">編集</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">削除</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="admin-modal" id="admin-modal-edit-user-{{ $user->id }}">
                                <a href="#" class="admin-modal-overlay"></a>
                                <div class="admin-modal-content">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="admin-form-group">
                                            <label for="admin-name">Name</label>
                                            <input type="text" id="admin-name" name="name" value="{{ old('name', $user->name) }}" required>
                                        </div>
                                        <div class="admin-form-group">
                                            <label for="admin-email">Email</label>
                                            <input type="email" id="admin-email" name="email" value="{{ old('email', $user->email) }}" required>
                                        </div>
                                        <div class="admin-form-group">
                                            <label for="admin-user_type">User Type</label>
                                            <select id="admin-user_type" name="user_type" required>
                                                <option value="general" {{ old('user_type', $user->user_type) == 'general' ? 'selected' : '' }}>
                                                    General
                                                </option>
                                                <option value="shop_owner" {{ old('user_type', $user->user_type) == 'shop_owner' ? 'selected' : '' }}>
                                                    Shop Owner
                                                </option>
                                                <option value="admin" {{ old('user_type', $user->user_type) == 'admin' ? 'selected' : '' }}>
                                                    Admin
                                                </option>
                                            </select>
                                        </div>
                                        <div class="admin-modal-actions">
                                            <a href="#" class="admin-modal-close admin-button">キャンセル</a>
                                            <button type="submit" class="admin-button">この内容で変更する</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="admin-modal" id="admin-modal-add-user">
                    <a href="#" class="admin-modal-overlay"></a>
                    <div class="admin-modal-content">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="admin-form-group">
                                <label for="admin-name">Name</label>
                                <input type="text" id="admin-name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="admin-form-group">
                                <label for="admin-email">Email</label>
                                <input type="email" id="admin-email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="admin-form-group">
                                <label for="admin-user_type">User Type</label>
                                <select id="admin-user_type" name="user_type" required>
                                    <option value="general" {{ old('user_type') == 'general' ? 'selected' : '' }}>
                                        General
                                    </option>
                                    <option value="shop_owner" {{ old('user_type') == 'shop_owner' ? 'selected' : '' }}>
                                        Shop Owner
                                    </option>
                                    <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                </select>
                            </div>
                            <input type="hidden" name="is_admin_request" value="true">
                            <div class="admin-modal-actions">
                                <a href="#" class="admin-modal-close admin-button">キャンセル</a>
                                <button type="submit" class="admin-button">この内容で新規登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section id="admin-content2">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">店舗</h2>
                    <div class="csv-upload">
                        <form action="{{ route('admin.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="csv_file" accept=".csv" class="csv-upload-input">
                            <button type="submit" class="csv-upload-button">CSVファイルをアップロード</button>
                        </form>

                    </div>
                    <a href="#admin-modal-add-shop" class="admin-button admin-button-create">＋新規追加</a>
                </div>
                <div class="admin-table-container">
                    <table class="admin-table">
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
                                    <a href="#admin-modal-edit-shop-{{ $shop->id }}" class="admin-button">編集</a>
                                    <form action="{{ route('admin-shops.destroy', $shop->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">削除</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="admin-modal" id="admin-modal-edit-shop-{{ $shop->id }}">
                                <a href="#" class="admin-modal-overlay"></a>
                                <div class="admin-modal-content">
                                    <form action="{{ route('admin-shops.update', $shop->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="admin-form-group">
                                            <label for="admin-shop_name">Shop Name</label>
                                            <input type="text" id="admin-shop_name" name="shop_name" value="{{ old('shop_name', $shop->shop_name) }}" required>
                                        </div>
                                        <div class="admin-form-group">
                                            <label for="admin-area_id">Area</label>
                                            <select id="admin-area_id" name="area_id" required>
                                                @foreach ($areas as $area)
                                                <option value="{{ $area->id }}" {{ old('area_id', $shop->area_id) == $area->id ? 'selected' : '' }}>
                                                    {{ $area->area_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="admin-form-group">
                                            <label for="admin-genre_id">Genre</label>
                                            <select id="admin-genre_id" name="genre_id" required>
                                                @foreach ($genres as $genre)
                                                <option value="{{ $genre->id }}" {{ old('genre_id', $shop->genre_id) == $genre->id ? 'selected' : '' }}>
                                                    {{ $genre->genre_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="admin-form-group">
                                            <label for="admin-user_id">User</label>
                                            <select id="admin-user_id" name="user_id" required>
                                                @foreach ($shopOwners as $shopOwner)
                                                <option value="{{ $shopOwner->id }}" {{ old('user_id', $shop->user_id) == $shopOwner->id ? 'selected' : '' }}>
                                                    {{ $shopOwner->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="admin-modal-actions">
                                            <a href="#" class="admin-modal-close admin-button">キャンセル</a>
                                            <button type="submit" class="admin-button">この内容で変更する</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="admin-modal" id="admin-modal-add-shop">
                    <a href="#" class="admin-modal-overlay"></a>
                    <div class="admin-modal-content">
                        <form action="{{ route('admin.shops.store') }}" method="POST">
                            @csrf
                            <div class="admin-form-group">
                                <label for="admin-shop_name">Shop Name</label>
                                <input type="text" id="admin-shop_name" name="shop_name" value="{{ old('shop_name') }}" required>
                            </div>
                            <div class="admin-form-group">
                                <label for="admin-area_id">Area</label>
                                <select id="admin-area_id" name="area_id" required>
                                    @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                                        {{ $area->area_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="admin-form-group">
                                <label for="admin-genre_id">Genre</label>
                                <select id="admin-genre_id" name="genre_id" required>
                                    @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->genre_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="admin-form-group">
                                <label for="admin-user_id">User</label>
                                <select id="admin-user_id" name="user_id" required>
                                    @foreach ($shopOwners as $shopOwner)
                                    <option value="{{ $shopOwner->id }}" {{ old('user_id') == $shopOwner->id ? 'selected' : '' }}>
                                        {{ $shopOwner->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="admin-modal-actions">
                                <a href="#" class="admin-modal-close admin-button">キャンセル</a>
                                <button type="submit" class="admin-button">この内容で新規登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section id="admin-content3">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">エリア</h2>
                    <a href="#admin-modal-add-area" class="admin-button admin-button-create">＋新規追加</a>
                </div>
                <div class="admin-table-container">
                    <table class="admin-table">
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
                                    <a href="#admin-modal-edit-area-{{ $area->id }}" class="admin-button">編集</a>
                                    <form action="{{ route('areas.destroy', $area->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">削除</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="admin-modal" id="admin-modal-edit-area-{{ $area->id }}">
                                <a href="#" class="admin-modal-overlay"></a>
                                <div class="admin-modal-content">
                                    <form action="{{ route('areas.update', $area->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="admin-form-group">
                                            <label for="admin-area_name">Area Name</label>
                                            <input type="text" id="admin-area_name" name="area_name" value="{{ old('area_name', $area->area_name) }}" required>
                                        </div>
                                        <div class="admin-modal-actions">
                                            <a href="#" class="admin-modal-close admin-button">キャンセル</a>
                                            <button type="submit" class="admin-button">この内容で変更する</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="admin-modal" id="admin-modal-add-area">
                    <a href="#" class="admin-modal-overlay"></a>
                    <div class="admin-modal-content">
                        <form action="{{ route('areas.store') }}" method="POST">
                            @csrf
                            <div class="admin-form-group">
                                <label for="admin-area_name">Area Name</label>
                                <input type="text" id="admin-area_name" name="area_name" value="{{ old('area_name') }}" required>
                            </div>
                            <div class="admin-modal-actions">
                                <a href="#" class="admin-modal-close admin-button">キャンセル</a>
                                <button type="submit" class="admin-button">この内容で新規登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section id="admin-content4">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">ジャンル</h2>
                    <a href="#admin-modal-add-genre" class="admin-button admin-button-create">＋新規追加</a>
                </div>
                <div class="admin-table-container">
                    <table class="admin-table">
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
                                    <a href="#admin-modal-edit-genre-{{ $genre->id }}" class="admin-button">編集</a>
                                    <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">削除</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="admin-modal" id="admin-modal-edit-genre-{{ $genre->id }}">
                                <a href="#" class="admin-modal-overlay"></a>
                                <div class="admin-modal-content">
                                    <form action="{{ route('genres.update', $genre->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="admin-form-group">
                                            <label for="admin-genre_name">Genre Name</label>
                                            <select id="admin-genre_name" name="genre_name" required>
                                                @foreach ($genres as $g)
                                                <option value="{{ $g->id }}" {{ old('genre_name', $genre->id) == $g->id ? 'selected' : '' }}>
                                                    {{ $g->genre_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="admin-modal-actions">
                                            <a href="#" class="admin-modal-close admin-button">キャンセル</a>
                                            <button type="submit" class="admin-button">この内容で変更する</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="admin-modal" id="admin-modal-add-genre">
                    <a href="#" class="admin-modal-overlay"></a>
                    <div class="admin-modal-content">
                        <form action="{{ route('genres.store') }}" method="POST">
                            @csrf
                            <div class="admin-form-group">
                                <label for="admin-genre_name">Genre Name</label>
                                <input type="text" id="admin-genre_name" name="genre_name" value="{{ old('genre_name') }}" required>
                            </div>
                            <div class="admin-modal-actions">
                                <a href="#" class="admin-modal-close admin-button">キャンセル</a>
                                <button type="submit" class="admin-button">この内容で新規登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script src="{{ asset('js/admin.js') }}"></script>

@endsection