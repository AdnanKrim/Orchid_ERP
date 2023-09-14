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
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('Date')->nullable();
            $table->integer('From')->nullable();
            $table->integer('To')->nullable();
            $table->integer('Product')->nullable();
            $table->integer('AvailableStock')->nullable();
            $table->integer('TransferQuantity')->nullable();
            $table->integer('TotalAmount')->nullable();
            $table->integer('ShippingCharge')->nullable();
            $table->string('Note')->nullable();
            $table->integer('TransferredBy')->nullable();
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
        Schema::dropIfExists('stock_transfers');
    }
};
