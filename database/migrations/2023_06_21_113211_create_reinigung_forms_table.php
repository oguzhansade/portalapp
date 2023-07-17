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
        Schema::create('reinigung_forms', function (Blueprint $table) {
            $table->id();
            $table->string('entryId')->nullable();
            $table->string('address')->nullable();
            $table->string('anzahlZimmer')->nullable();
            $table->string('m2')->nullable();
            $table->date('reinigungTermin')->nullable();
            $table->string('unternehmen')->nullable();
            $table->string('anrede')->nullable();
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->string('telefon')->nullable();
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
        Schema::dropIfExists('reinigung_forms');
    }
};
