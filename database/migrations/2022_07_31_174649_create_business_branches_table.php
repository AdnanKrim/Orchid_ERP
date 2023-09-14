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
        Schema::create('business_branches', function (Blueprint $table) {
            $table->id();
            $table->string('branchName')->nullable();
            $table->string('branchHead')->nullable();
           // $table->string('companyId')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
           // $table->string('branchLocation')->nullable();
            $table->string('phoneNo')->nullable();
            $table->string('email')->nullable();
            //$table->string('status')->nullable();
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
        Schema::dropIfExists('business_branches');
    }
};
