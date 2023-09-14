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
        Schema::create('immigrations', function (Blueprint $table) {
            $table->id();
            $table->integer('EmployeeId')->nullable();
            $table->string('DocumentType')->nullable();
            $table->string('DocumentNumber')->nullable();
            $table->string('IssueDate')->nullable();
            $table->string('ExpiryDate')->nullable();
            $table->string('DocumentFile')->nullable();
            $table->string('ReviewDate')->nullable();
            $table->string('Country')->nullable();
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
        Schema::dropIfExists('immigrations');
    }
};
