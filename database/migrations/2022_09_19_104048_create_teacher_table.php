<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherTable extends Migration
{
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('mobile');
            $table->string('subject');
            $table->string('image');
            $table->enum('gender', ['0','1','2'])->comment('0-male,1-female,2-other');
            $table->enum('status', ['0','1','2'])->comment('0-active,1-in-active,2-delete');
            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('teacher');
    }
}
