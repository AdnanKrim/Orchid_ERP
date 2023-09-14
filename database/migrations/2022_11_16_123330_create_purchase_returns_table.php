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
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->id();
            $table->string('purchaseReturnId')->nullable();
            $table->string('purchaseInvoice')->nullable();
            $table->integer('clientId')->nullable();
            $table->integer('supplierId')->nullable();
            $table->integer('projectId')->nullable();
            $table->text('products')->nullable()->comment('productId, qty, rate, totalPrice');
            $table->string('shipment')->nullable();
            $table->string('grandTotal')->nullable();
            $table->string('paid')->nullable();
            $table->string('due')->nullable();
            $table->string('date')->nullable();
            $table->string('paymentStatus')->nullable();
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
        Schema::dropIfExists('purchase_returns');
    }
};
