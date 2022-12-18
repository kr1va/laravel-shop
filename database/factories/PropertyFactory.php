<?php

namespace Database\Factories;

use Domain\Product\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Product\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Property::class;

    public function definition()
    {
        return [
            'title' => ucfirst($this->faker->word())
        ];
    }
}
