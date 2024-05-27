<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

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
            'evaluation' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->paragraph,
        ];
    }
}
