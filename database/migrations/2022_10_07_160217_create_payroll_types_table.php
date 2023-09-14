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
        Schema::create('payroll_types', function (Blueprint $table) {
            $table->id();
            $table->string('payrollTypeName')->nullable();
            $table->float('percentage')->nullable();
            $table->double('tk')->nullable();
            $table->string('payrollGenerate')->nullable();
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
        Schema::dropIfExists('payroll_types');
    }
};
