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
        Schema::create('house_area_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('quotationId')->nullable();
            $table->integer('houseAreaTypeId')->nullable();
            $table->text('houseAreaCartInfo')->nullable()->comment('Object (decorationTypeId, descriptionOfDecoration, qty, rate, totalAmount)');
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
        Schema::dropIfExists('house_area_carts');
    }
};
