<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentTable extends Migration
{
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("slug", 150);
            $table->string('title');
            $table->string('semester');
            $table->enum('status', ['0','1','2'])->comment('0-active,1-in-active,2-delete');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('department');
    }
}
