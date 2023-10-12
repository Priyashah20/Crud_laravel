<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' =>$this->faker->name,
            'price' => $this->faker->numberBetween($min=10, $max=100),
            'status' =>'Active',
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'quantity' => $this->faker->numberBetween($min=10, $max=100),
            //'image'=>$this->faker->image('public/image',640,480, null, false),
            'description' => $this->faker->text,

        ];
    }
}
