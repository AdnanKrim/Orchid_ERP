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
        Schema::create('project_deals', function (Blueprint $table) {
            $table->id();
            $table->string('startDate')->nullable();
            $table->string('endDate')->nullable();
            $table->Integer('duration')->nullable();
            $table->Integer('category')->nullable();
            $table->Integer('clientId')->nullable();
            $table->string('projectName')->nullable();
            $table->string('projectInvoice')->nullable();
            $table->Integer('branchId')->nullable();
            $table->double('amount')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('project_deals');
    }
};
