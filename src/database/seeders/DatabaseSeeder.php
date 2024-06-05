<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->count(5)->create();
        Genre::factory()->count(5)->create();
        Shop::factory()->count(5)->create();
        Favorite::factory()->count(5)->create();
        Reservation::factory()->count(5)->create();
        Review::factory()->count(5)->create();

        $this->call(AreasTableSeeder::class);
    }
}
