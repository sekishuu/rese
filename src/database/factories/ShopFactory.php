<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shop_name' => $this->faker->company,
            'shop_address' => $this->faker->address,
            'tel' => $this->faker->phoneNumber,
            'shop_info' => $this->faker->paragraph,
            'shop_image' => $this->faker->imageUrl,
            'area_id' => \App\Models\Area::factory(), // ランダムなエリアIDを設定
            'genre_id' => \App\Models\Genre::factory(), // ランダムなジャンルIDを設定
        ];
    }
}
