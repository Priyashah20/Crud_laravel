<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BrowserStat;

class BrowserStatSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array(
                "name" => "Chrome",
                "total_usage" => 64.02
            ),
            array(
                "name" => "Firefox",
                "total_usage" => 12.55
            ),
            array(
                "name" => "IE",
                "total_usage" => 8.47
            ),
            array(
                "name" => "Safari",
                "total_usage" => 6.08
            ),
            array(
                "name" => "Edge",
                "total_usage" => 4.29
            ),
            array(
                "name" => "Others",
                "total_usage" => 4.59
            )
        ];
         BrowserStat::insert($data);
    }
}
