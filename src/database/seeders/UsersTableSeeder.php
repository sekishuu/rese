<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites')->delete();
        DB::table('users')->delete();

        User::create([
            'name' => '一般太郎',
            'email' => 'ippan@example.com',
            'password' => Hash::make('0000'),
            'user_type' => 'general',
        ]);

        User::create([
            'name' => '山田一般ユーザーけんじ',
            'email' => 'ippan.kenji@example.com',
            'password' => Hash::make('0000'),
            'user_type' => 'general',
        ]);

        User::create([
            'name' => '本田たかひろ',
            'email' => 'ippan.honda@example.com',
            'password' => Hash::make('0000'),
            'user_type' => 'general',
        ]);

        User::create([
            'name' => '店舗管理者太郎',
            'email' => 'tenpo@example.com',
            'password' => Hash::make('0000'),
            'user_type' => 'shop_owner',
        ]);
        User::create([
            'name' => '店舗管理者トーマス',
            'email' => 'tenpo.thomas@example.com',
            'password' => Hash::make('0000'),
            'user_type' => 'shop_owner',
        ]);

        User::create([
            'name' => '店舗管理者ゆうじろう',
            'email' => 'tenpo.yujiro@example.com',
            'password' => Hash::make('0000'),
            'user_type' => 'shop_owner',
        ]);

        User::create([
            'name' => 'サイト管理者太郎',
            'email' => 'admin@example.com',
            'password' => Hash::make('0000'),
            'user_type' => 'admin',
        ]);
    }
}
