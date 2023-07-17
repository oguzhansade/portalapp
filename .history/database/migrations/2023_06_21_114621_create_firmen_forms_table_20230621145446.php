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
        Schema::create('firmen_forms', function (Blueprint $table) {
            $table->id();
            $table->string('entryId')->nullable();
            $table->string('vonStrasse')->nullable();
            $table->string('vonPlzOrt')->nullable();
            $table->string('anzahlRaume')->nullable();
            $table->string('vonEtage')->nullable();
            $table->string('vonLift')->nullable();
            $table->string('nachStrasse')->nullable();
            $table->string('nachPlzOrt')->nullable();
            $table->string('nachEtage')->nullable();
            $table->date('umzugDate')->nullable();
            $table->string('nachLift')->nullable();
            $table->string('firma')->nullable();
            $table->string('andrede')->nullable();
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->string('telefon')->nullable();
            $table->text('bemerkungen')->nullable();
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
        Schema::dropIfExists('firmen_forms');
    }
};
