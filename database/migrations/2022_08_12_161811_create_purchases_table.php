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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchaseCategory')->nullable();
            $table->string('purchaseId')->nullable();
            $table->integer('userId')->nullable();
            $table->integer('clientId')->nullable();
            $table->integer('supplierId')->nullable();
            $table->integer('projectId')->nullable();
            $table->text('products')->nullable()->comment('productId, qty, rate, totalPrice');
            $table->string('grandTotal')->nullable();
            $table->string('paid')->nullable();
            $table->string('due')->nullable();
            $table->string('date')->nullable();
            $table->string('paymentStatus')->nullable();
            $table->string('branch')->nullable();
            $table->string('status')->nullable()->comment('0 = purchase proposal, 1 = purchase approved, 2 = total list ');
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
        Schema::dropIfExists('purchases');
    }
};
