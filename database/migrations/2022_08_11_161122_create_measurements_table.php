<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->integer('leedsId')->nullable();
            $table->string('totalAmount')->nullable();
            $table->string('discount')->nullable();
            $table->string('vat')->nullable();
            $table->string('grandTotal')->nullable();
            $table->string('advanced')->nullable();
            $table->string('totalPayableAmount')->nullable();
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
        Schema::dropIfExists('measurements');
    }
};
