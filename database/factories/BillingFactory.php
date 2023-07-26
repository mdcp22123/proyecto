<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Billing>
 */
class BillingFactory extends Factory
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
            'number'=>$this->faker->randomNumber(8,true),
            'voucher'=>$this->faker->randomElement(['1','2']),
            'serie'=>'F001',
            'correlative'=>'000'.$this->faker->randomNumber(3,false),

            'status'=>$this->faker->randomElement(['1','2','3']),
        
            'sale_id'=>Sale::all()->random()->id,  

            'net'=>$this->faker->randomFloat(2,100,1000), 
             'tax'=>$this->faker->randomFloat(2,100,1000),
            'discount'=>$this->faker->randomFloat(2,100,1000),
            'total'=>$this->faker->randomFloat(2,100,1000),
        ];
    }
}
