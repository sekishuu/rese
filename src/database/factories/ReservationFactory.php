<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // ランダムなユーザーIDを設定
            'shop_id' => \App\Models\Shop::factory(), // ランダムな店舗IDを設定
            'reserve_date' => $this->faker->date,
            'reserve_time' => $this->faker->time,
            'number_of_people' => $this->faker->numberBetween(1, 10),
        ];
    }
}
