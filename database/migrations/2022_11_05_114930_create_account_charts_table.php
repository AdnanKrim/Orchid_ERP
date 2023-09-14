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
        Schema::create('account_charts', function (Blueprint $table) {
            $table->id();
            $table->integer('AccountType')->nullable();
            $table->integer('AccountGroup')->nullable();
            $table->string('AccountName')->nullable();
            $table->string('Side')->nullable();
            $table->string('AccountCode')->nullable();
            $table->integer('Balance')->nullable();
            $table->string('Date')->nullable();
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
        Schema::dropIfExists('account_charts');
    }
};
