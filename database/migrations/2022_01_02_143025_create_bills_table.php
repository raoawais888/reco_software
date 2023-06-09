<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('name')->nullable();
            $table->string('client_name')->nullable();
            $table->string('number')->nullable();
            $table->string('description')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('price')->nullable();
            $table->integer('code')->nullable();
            $table->string('bill_number')->nullable();
            $table->integer('branch')->nullable();
            $table->integer('status')->nullable();
            $table->integer('disccount')->nullable();
            $table->string('disccount_type')->nullable();

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
        Schema::dropIfExists('bills');
    }
}
