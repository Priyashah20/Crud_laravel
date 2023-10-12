<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderitemTable extends Migration
{
    public function up()
    {
        Schema::create('orderitem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('qty');
            $table->text('price');
            $table->text('total_price');
            $table->enum('status', ['0','1','2'])->comment('0-pending,1-success,2-deliever');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orderitem');
    }
}
