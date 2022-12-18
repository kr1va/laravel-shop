<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class SignUpFormRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->freeEmail,
            'password' => $this->faker->password(8)
        ];
    }
}
