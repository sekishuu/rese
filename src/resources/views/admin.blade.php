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
                                        <button>編集</button>
                                        <button>削除</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
                <section id="content2">
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
                                        <button>編集</button>
                                        <button>削除</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
                <section id="content3">
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
                                        <button>編集</button>
                                        <button>削除</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
                <section id="content4">
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
                                        <button>編集</button>
                                        <button>削除</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
@endsection
