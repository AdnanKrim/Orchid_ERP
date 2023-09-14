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
        Schema::create('menu_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('userId')->nullable();
            $table->text('menuIds')->nullable()->comment('Object - menu ids');
            $table->text('subMenuIds')->nullable()->comment('Object - sub menu ids');
            $table->text('subsubMenuIds')->nullable()->comment('Object - sub sub menu ids');
            $table->text('actions')->nullable()->comment('Object - CREATE, EDIT, DELETE');
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
        Schema::dropIfExists('menu_permissions');
    }
};
