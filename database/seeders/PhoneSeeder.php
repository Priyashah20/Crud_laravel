<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Phone;

class PhoneSeeder extends Seeder
{
    public function run()
    {
        Phone::factory()->count(50)->create();
    }
}
