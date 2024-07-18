<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->truncate();

        $areas = [
            ['area_name' => '北海道'],
            ['area_name' => '青森県'],
            ['area_name' => '岩手県'],
            ['area_name' => '宮城県'],
            ['area_name' => '秋田県'],
            ['area_name' => '山形県'],
            ['area_name' => '福島県'],
            ['area_name' => '茨城県'],
            ['area_name' => '栃木県'],
            ['area_name' => '群馬県'],
            ['area_name' => '埼玉県'],
            ['area_name' => '千葉県'],
            ['area_name' => '東京都'],
            ['area_name' => '神奈川県'],
            ['area_name' => '新潟県'],
            ['area_name' => '富山県'],
            ['area_name' => '石川県'],
            ['area_name' => '福井県'],
            ['area_name' => '山梨県'],
            ['area_name' => '長野県'],
            ['area_name' => '岐阜県'],
            ['area_name' => '静岡県'],
            ['area_name' => '愛知県'],
            ['area_name' => '三重県'],
            ['area_name' => '滋賀県'],
            ['area_name' => '京都府'],
            ['area_name' => '大阪府'],
            ['area_name' => '兵庫県'],
            ['area_name' => '奈良県'],
            ['area_name' => '和歌山県'],
            ['area_name' => '鳥取県'],
            ['area_name' => '島根県'],
            ['area_name' => '岡山県'],
            ['area_name' => '広島県'],
            ['area_name' => '山口県'],
            ['area_name' => '徳島県'],
            ['area_name' => '香川県'],
            ['area_name' => '愛媛県'],
            ['area_name' => '高知県'],
            ['area_name' => '福岡県'],
            ['area_name' => '佐賀県'],
            ['area_name' => '長崎県'],
            ['area_name' => '熊本県'],
            ['area_name' => '大分県'],
            ['area_name' => '宮崎県'],
            ['area_name' => '鹿児島県'],
            ['area_name' => '沖縄県'],
        ];

        DB::table('areas')->insert($areas);
    }
}
