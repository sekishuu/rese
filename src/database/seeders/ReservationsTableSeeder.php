<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Shop;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->delete();

        $users = User::all()->keyBy('name');
        $shops = Shop::all()->keyBy('shop_name');


        function randomDateInCurrentYear()
        {
            $year = date('Y');
            $month = rand(1, 12);
            $day = rand(1, 28);
            return "$year-$month-$day";
        }

        $reservations = [
            [
                'user_id' => $users['一般太郎']->id,
                'shop_id' => $shops['仙人']->id,
                'reserve_date' => randomDateInCurrentYear(),
                'reserve_time' => '18:00',
                'number_of_people' => 1,
            ],
            [
                'user_id' => $users['山田一般ユーザーけんじ']->id,
                'shop_id' => $shops['牛助']->id,
                'reserve_date' => randomDateInCurrentYear(),
                'reserve_time' => '18:00',
                'number_of_people' => 5,
            ],
            [
                'user_id' => $users['本田たかひろ']->id,
                'shop_id' => $shops['戦慄']->id,
                'reserve_date' => randomDateInCurrentYear(),
                'reserve_time' => '18:00',
                'number_of_people' => 10,
            ],
        ];

        DB::table('reservations')->insert($reservations);
    }
}
