<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'net'=>$this->faker->randomFloat(2,100,1000), 
             'tax'=>$this->faker->randomFloat(2,100,1000),
            'discount'=>$this->faker->randomFloat(2,100,1000),
            /* 'subtotal'=>$this->faker->randomFloat(2,100,1000), */
            'total'=>$this->faker->randomFloat(2,100,1000),
           /*  'rounding'=>$this->faker->randomFloat(2,100,1000), */
            'cash'=>$this->faker->randomFloat(2,100,1000),
            'change'=>$this->faker->randomFloat(2,100,1000),

         
              'observation'=>$this->faker->sentence(5),
            'user_id'=>User::all()->random()->id,
            'patient_id'=>Patient::all()->random()->id,    
        ];
    }
}
