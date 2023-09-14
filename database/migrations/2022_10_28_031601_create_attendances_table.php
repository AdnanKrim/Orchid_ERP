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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('Date')->nullable();
            $table->Integer('Employee')->nullable();
            $table->Integer('Status')->nullable();
            $table->string('InTime')->nullable();
            $table->string('OutTime')->nullable();
            $table->string('Late')->nullable();
            $table->string('EarlyExit')->nullable();
            $table->string('WorkingHour')->nullable();
            $table->string('OtHour')->nullable();
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
        Schema::dropIfExists('attendances');
    }
};
