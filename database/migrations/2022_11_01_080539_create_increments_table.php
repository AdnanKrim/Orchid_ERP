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
        Schema::create('increments', function (Blueprint $table) {
            $table->id();
            $table->integer('Employee')->nullable();
            $table->double('BeforeSalary')->nullable();
            $table->double('IncrementSalary')->nullable();
            $table->double('NewSalary')->nullable();
            $table->string('EffectiveDate')->nullable();
            $table->string('Note')->nullable();
            $table->integer('IncrementBy')->nullable();
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
        Schema::dropIfExists('increments');
    }
};
