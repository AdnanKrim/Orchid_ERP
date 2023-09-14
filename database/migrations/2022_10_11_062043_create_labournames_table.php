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
        Schema::create('labournames', function (Blueprint $table) {
            $table->id();
            $table->string('labourName')->nullable();
            $table->string('labourId')->nullable();
            $table->string('mob1No')->nullable();
            $table->string('mob2No')->nullable();
            $table->string('email')->nullable();
            $table->string('subDistrict')->nullable();
            $table->string('district')->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('labournames');
    }
};
