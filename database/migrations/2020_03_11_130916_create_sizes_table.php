<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSizesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('sizes')) {
            Schema::create('sizes', function (Blueprint $table) {
                $table->integer('id')->primary();
                $table->string('size');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        if (Schema::hasTable('sizes')) {
            DB::table('sizes')->insert([
                ['id' => 1, 'size' => 'Large'],
                ['id' => 2, 'size' => 'medium'],
                ['id' => 3, 'size' => 'small']
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
}
