<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('orders') && Schema::hasTable('customers') && Schema::hasTable('pizzas')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('customer_id')->unsigned();
                $table->foreign('customer_id')->references('id')->on('customers');
                $table->bigInteger('pizza_id')->unsigned();
                $table->foreign('pizza_id')->references('id')->on('pizzas');
                $table->string('status')->default('hold');
                $table->integer('quantity')->default(1);
                $table->enum('size', ['large', 'medium', 'small']);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
