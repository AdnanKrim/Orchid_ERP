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
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->string('Date')->nullable();
            $table->integer('Branch')->nullable();
            $table->string('AdjustmentType')->nullable();
            $table->string('Reason')->nullable();
            $table->integer('Product')->nullable();
            $table->integer('AvailableStock')->nullable();
            $table->integer('NewStock')->nullable();
            $table->integer('AdjustmentQuantity')->nullable();
            $table->string('Operator')->nullable();
            $table->string('TotalAmount')->nullable();
            $table->string('Note')->nullable();
            $table->integer('AdjustedBy')->nullable();
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
        Schema::dropIfExists('stock_adjustments');
    }
};
