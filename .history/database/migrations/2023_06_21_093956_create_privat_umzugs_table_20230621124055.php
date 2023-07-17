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
        Schema::create('privat_umzugs', function (Blueprint $table) {
            $table->id();
            $table->string('entryId')->nullable();
            $table->string('strasse')->nullable();
            $table->string('plzOrt')->nullable();
            $table->string('anzahlZimmer')->nullable();
            $table->string('etage')->nullable();
            $table->string('lift')->nullable();
            $table->string('weitere')->nullable();
            $table->date('umzugDate')->nullable();
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->string('telefon')->nullable();
            $table->text('bemerkungen')->nullable();
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
        Schema::dropIfExists('privat_umzugs');
    }
};
