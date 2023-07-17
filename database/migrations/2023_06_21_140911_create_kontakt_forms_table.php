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
        Schema::create('kontakt_forms', function (Blueprint $table) {
            $table->id();
            $table->string('entryId')->nullable();
            $table->string('anrede')->nullable();
            $table->string('fullname')->nullable();
            $table->string('mail')->nullable();
            $table->string('telefon')->nullable();
            $table->text('nachricht')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('kontakt_forms');
    }
};
