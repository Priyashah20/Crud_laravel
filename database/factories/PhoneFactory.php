<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Phone;

class PhoneFactory extends Factory
{
    protected $model = Phone::class;
    public function definition()
    {
        return [
            "user_id" => \App\Models\User::factory()->create()->id,
            "phone" => $this->faker->phoneNumber
        ];
    }
}
