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
        Schema::create('measurement_cart_childlesses', function (Blueprint $table) { $table->id();
            $table->integer('measurementId')->nullable();
            $table->integer('measurementTypeId')->nullable();
            $table->string('totalQty')->nullable();
            $table->string('totalAmount')->nullable();
            $table->text('measurementCartInfo')->nullable();
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
        Schema::dropIfExists('measurement_cart_childlesses');
    }
};
