<?php

namespace Database\Factories;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    protected $model = Member::class;
    public function definition()
    {
        return [

            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
           // 'email_verified_at' => now(),
            'password' => bcrypt("123456"), // password
            //'remember_token' => Str::random(10),
        ];
    }
}
