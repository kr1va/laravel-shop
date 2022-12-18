<?php

namespace Database\Factories;

use Domain\Product\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Options>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Option::class;

    public function definition()
    {
        return [
            'title' => ucfirst($this->faker->word())
        ];
    }
}
