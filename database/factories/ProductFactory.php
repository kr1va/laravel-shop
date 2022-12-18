<?php

namespace Database\Factories;

use Domain\Catalog\Model\Brand;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(2, true)),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'thumbnail' => $this->faker->fixturesImage('products', 'products'),
//            'thumbnail' => $this->faker->loremFlickr('images/products'),
            'price' => $this->faker->numberBetween(10000, 10000000),
            "on_home_page" => $this->faker->boolean(),
            'sorting' => $this->faker->numberBetween(1, 999),
            'quantity' => $this->faker->numberBetween(1, 20),
            'text' => $this->faker->realText(),
        ];
    }
}
