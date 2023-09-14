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
        Schema::create('adjusting_journal_entry_values', function (Blueprint $table) {
            $table->id();
            $table->integer('journalEntryId')->nullable();
            $table->integer('chartOfAccountId')->nullable();
            $table->string('debit')->nullable();
            $table->string('credit')->nullable();
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
        Schema::dropIfExists('adjusting_journal_entry_values');
    }
};
