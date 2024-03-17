<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAttribute>
 */
class UserAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street1' => fake()->streetName,
            'street2' => fake()->streetName,
            'city' => fake()->city,
            'postal_code' => fake()->postcode,
            'country_id' => Country::inRandomOrder()->first()->id,
        ];
    }
}
