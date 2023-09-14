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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('companyOrStoreName')->nullable();
            $table->integer('supplierGroupId')->nullable();
            $table->string('supplierId')->nullable()->comment('auto generate');
            $table->integer('productId')->nullable();
            $table->string('ownerName')->nullable();
            $table->text('businessAddress')->nullable();
            $table->string('phoneNo')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('supplierCountry')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
};
