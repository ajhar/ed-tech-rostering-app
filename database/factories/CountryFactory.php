<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $symbols = ['!', '@', '#', '$', '%', '^', '&', '*', '+', '=', '?', '|'];
        return [
            'country_code' => fake()->countryCode,
            'name' => fake()->country,
            'alpha3_country_code' => Str::upper(fake()->lexify('???')),
            'currency_name' => fake()->word,
            'currency_code' => fake()->currencyCode,
            'currency_symbol' => fake()->randomElement($symbols)
        ];
    }
}
