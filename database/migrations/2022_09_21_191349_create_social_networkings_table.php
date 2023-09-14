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
        Schema::create('social_networkings', function (Blueprint $table) {
            $table->id();
            $table->integer('EmployeeId')->nullable();
            $table->string('facebookProfile')->nullable();
            $table->string('twitterProfile')->nullable();
            $table->string('bloggerProfile')->nullable();
            $table->string('linkedinProfile')->nullable();
            $table->string('googlePlusProfile')->nullable();
            $table->string('instagramProfile')->nullable();
            $table->string('pinterestProfile')->nullable();
            $table->string('youtubeProfile')->nullable();
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
        Schema::dropIfExists('social_networkings');
    }
};
