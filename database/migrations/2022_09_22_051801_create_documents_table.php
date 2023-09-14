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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('EmployeeId')->nullable();
            $table->string('documentType')->nullable();
            $table->string('title')->nullable();
            $table->string('notificationEmail')->nullable();
            $table->string('dateOfExpiry')->nullable();
            $table->string('documentFile')->nullable();
            $table->string('notificationAfterExpire')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('documents');
    }
};
