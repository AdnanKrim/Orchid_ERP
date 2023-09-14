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
        Schema::create('project_estimates', function (Blueprint $table) {
            $table->id();
            $table->integer('clientId')->nullable();
            $table->integer('branchId')->nullable();
            $table->integer('projectId')->nullable();
            $table->text('products')->nullable()->comment('productName, quantity, unitPrice, amount');
            $table->string('grandTotal')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('project_estimates');
    }
};
