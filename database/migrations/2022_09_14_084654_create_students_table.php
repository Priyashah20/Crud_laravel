<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('mobile');
            $table->enum('gender', ['0','1','2'])->comment('0-male,1-female,2-other');
            $table->string('image');
            $table->enum('status', ['0','1','2'])->comment('0-active,1-in-active,2-delete');
            $table->string('address');
            $table->string('city');
            $table->string('semester');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
