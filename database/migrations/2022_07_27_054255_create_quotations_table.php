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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->integer('leedsId')->nullable();
            $table->string('subject')->nullable();
            $table->text('body')->nullable();
            $table->integer('totalAmount')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('totalVat')->nullable();
            $table->integer('grandTotal')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('quotations');
    }
};
