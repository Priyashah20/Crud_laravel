<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHobbiesStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('hobby')->nullable();
            $table->string('state');
        });
    }
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
        });
    }
}
