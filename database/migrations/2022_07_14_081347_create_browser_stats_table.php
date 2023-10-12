<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrowserStatsTable extends Migration
{
    public function up()
    {
        Schema::create('browser_stats', function (Blueprint $table) {
            $table->id();
            $table->string("name", 30);
            $table->float("total_usage");
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('browser_stats');
    }
}
