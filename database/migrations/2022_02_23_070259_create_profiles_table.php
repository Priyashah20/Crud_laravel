<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('number');
            $table->string('password');
            $table->string('email');
            $table->string('image');
            $table->enum('status', ['Block', 'Unblock']);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
