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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('accName');
            $table->integer('openingBalance');
            $table->string('accType')->nullable();
            $table->integer('accNo');
            $table->string('bank')->nullable();
            $table->string('bankAcc')->nullable();
            $table->string('branch')->nullable();
            $table->string('mobileService')->nullable();
            $table->string('numberType')->nullable();
            $table->string('status')->default('active');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('accounts');
    }
};
