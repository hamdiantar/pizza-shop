<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzaSizesTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pizza_sizes') && Schema::hasTable('pizzas') && Schema::hasTable('sizes')) {
            Schema::create('pizza_sizes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('pizza_id')->unsigned();
                $table->foreign('pizza_id')->references('id')->on('pizzas');
                $table->integer('size_id');
                $table->foreign('size_id')->references('id')->on('sizes');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pizza_sizes');
    }
}
