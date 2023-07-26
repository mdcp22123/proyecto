<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detail>
 */
class DetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'quantity'=>$this->faker->randomDigit,
            'price_u'=>$this->faker->randomFloat(2,100,1000),
            'net_u'=>$this->faker->randomFloat(2,100,1000),
            'tax_u'=>$this->faker->randomFloat(2,100,1000),
            'net_t'=>$this->faker->randomFloat(2,100,1000),
            'tax_t'=>$this->faker->randomFloat(2,100,1000),
            'price'=>$this->faker->randomFloat(2,100,1000),
            'price_t'=>$this->faker->randomFloat(2,100,1000),
            'description'=>$this->faker->text,
            'sale_id'=>Sale::all()->random()->id,
            'service_id'=>Service::all()->random()->id,

        ];
    }
}
