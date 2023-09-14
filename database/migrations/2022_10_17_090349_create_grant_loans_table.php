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
        Schema::create('grant_loans', function (Blueprint $table) {
            $table->id();
            $table->Integer('Employee')->nullable();
            $table->double('LoanAmount')->nullable();
            $table->string('LoanDetails')->nullable();
            $table->double('InterestPercentage')->nullable();
            $table->string('InstallmentPeriod')->nullable();
            $table->double('TotalInterestAmount')->nullable();
            $table->double('TotalRepayment')->nullable();
            $table->string('RepaymentFrom')->nullable();
            $table->Integer('PermittedBy')->nullable();
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
        Schema::dropIfExists('grant_loans');
    }
};
