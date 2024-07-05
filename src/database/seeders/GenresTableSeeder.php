<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            ['genre_name' => '寿司'],
            ['genre_name' => '焼肉'],
            ['genre_name' => '居酒屋'],
            ['genre_name' => 'イタリアン'],
            ['genre_name' => 'ラーメン'],
        ];

        DB::table('genres')->insert($genres);
    }
}
