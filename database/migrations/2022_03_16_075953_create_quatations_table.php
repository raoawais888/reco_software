<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuatationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quatations', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('name')->nullable();
            $table->string('client_name')->nullable();
            $table->string('number')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('price')->nullable();
            $table->string('bill_number')->nullable();
            $table->integer('status')->nullable();
            $table->integer('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quatations');
    }
}
