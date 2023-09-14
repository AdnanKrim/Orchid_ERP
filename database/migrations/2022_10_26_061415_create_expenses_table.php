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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('expCategoryId');
            $table->integer('branchId');
            $table->string('for')->nullable();
            $table->bigInteger('expAmount');
            $table->text('file')->nullable();
            $table->text('expNote')->nullable();
            $table->integer('clientId');
            $table->integer('userId');
            $table->text('paymentStatus');
            $table->bigInteger('paymentAmount')->nullable();
            $table->integer('accountId');
            $table->text('paymentNote')->nullable();
            $table->text('due')->nullable();
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
        Schema::dropIfExists('expenses');
    }
};
