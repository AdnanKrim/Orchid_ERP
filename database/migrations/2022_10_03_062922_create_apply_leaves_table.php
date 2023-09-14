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
        Schema::create('apply_leaves', function (Blueprint $table) {
            $table->id();
            $table->string('dateOfApplication')->nullable();
            $table->string('leaveDate')->nullable();
            $table->Integer('Employee')->nullable();
            $table->Integer('LeaveType')->nullable();
            $table->Integer('LeavePurpose')->nullable();
            $table->string('startDate')->nullable();
            $table->string('endDate')->nullable();
            $table->Integer('totalDays')->nullable();
            $table->string('details')->nullable();
            $table->string('file')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('apply_leaves');
    }
};
