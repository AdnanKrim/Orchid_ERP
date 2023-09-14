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
        Schema::create('leeds', function (Blueprint $table) {
            $table->id();
            $table->string('clientName')->nullable();
            $table->string('leedsGroupId')->nullable();
            $table->string('phoneNo')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('area')->nullable();
            $table->string('district')->nullable()->comment("All district list in dropdown, Selected value Dhaka");
            $table->string('zipCode')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->string('country')->nullable()->comment("All country list in dropdown, selected value Bangladesh");
            $table->string('clientPriority')->nullable()->comment('1.Important, 2.Normal, 3.Emergency, 4.Rejected');
            $table->string('clientValue')->nullable()->comment('1.Low, 2.Medium, 3.High');
            $table->string('source')->nullable()->comment('Facebook, Google, Youtube, Twitter, Instagram, Others');
            $table->integer('assignedTo')->nullable()->comment('UserId by User name');
            $table->text('comment')->nullable();
            $table->string('status')->nullable();
            $table->integer('isSuccess')->default(0);
            $table->integer('isClient')->default(0);
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
        Schema::dropIfExists('leeds');
    }
};
