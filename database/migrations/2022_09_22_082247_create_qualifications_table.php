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
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->integer('EmployeeId')->nullable();
            $table->string('Institution')->nullable();
            $table->string('From')->nullable();
            $table->string('To')->nullable();
            $table->string('EducationLevel')->nullable();
            $table->string('Language')->nullable();
            $table->string('ProfessionalCertificate')->nullable();
            $table->string('Description')->nullable();
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
        Schema::dropIfExists('qualifications');
    }
};
