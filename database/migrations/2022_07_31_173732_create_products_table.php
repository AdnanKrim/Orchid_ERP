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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productName')->nullable();
            $table->string('productCode')->nullable();
            $table->string('SKU')->nullable();
            $table->integer('categoryId')->nullable();
            $table->integer('subCategoryId')->nullable();
            $table->integer('unitId')->nullable();
            $table->integer('brandId')->nullable();
            $table->integer('modelId')->nullable();
            $table->integer('sizeId')->nullable();
            $table->integer('colorId')->nullable();
            $table->string('length')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->integer('businessBranchId')->nullable();
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
        Schema::dropIfExists('products');
    }
};
