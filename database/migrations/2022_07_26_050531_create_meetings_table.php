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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('leedsId')->nullable();
            $table->string('meetingDateAndTime')->nullable();
            $table->string('phoneNo')->nullable();
            $table->string('address')->nullable();
            $table->integer('userId')->nullable();
            $table->integer('projectCategoryId')->nullable();
            $table->text('detail')->nullable();
            $table->text('clientComments')->nullable();
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
        Schema::dropIfExists('meetings');
    }
};
