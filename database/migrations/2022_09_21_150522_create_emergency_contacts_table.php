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
        Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('EmployeeId')->nullable();
            $table->string('Relation')->nullable();
            $table->string('RelationType')->nullable();
            $table->string('WorkEmail')->nullable();
            $table->string('PersonalEmail')->nullable();
            $table->string('Name')->nullable();
            $table->string('Address1')->nullable();
            $table->string('Address2')->nullable();
            $table->string('State')->nullable();
            $table->string('City')->nullable();
            $table->string('Country')->nullable();
            $table->string('WorkPhone')->nullable();
            $table->string('MobilePhone')->nullable();
            $table->string('HomePhone')->nullable();
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
        Schema::dropIfExists('emergency_contacts');
    }
};
