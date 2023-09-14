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
        Schema::create('labourbills', function (Blueprint $table) {
            $table->id();
            $table->string('labourNameId')->nullable();
            $table->integer('labourTypeId')->nullable();
            $table->integer('clientId')->nullable();
            $table->string('labourId')->nullable();
            $table->integer('purchaseCategoryId')->nullable();
            $table->text('products')->nullable()->comment('productId, qty, rate, totalPrice');
            $table->string('grandTotal')->nullable();
            $table->string('paid')->nullable();
            $table->string('due')->nullable();
            $table->string('date')->nullable();
            $table->string('paymentStatus')->nullable();
            $table->string('paymentMethod')->nullable();
            $table->string('CSFCAmount')->nullable();
            $table->string('finalTotal')->nullable();
            $table->string('paymentNote')->nullable();
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
        Schema::dropIfExists('labourbills');
    }
};
