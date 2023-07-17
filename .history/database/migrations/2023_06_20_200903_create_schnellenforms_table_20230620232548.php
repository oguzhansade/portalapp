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
        Schema::create('schnellenforms', function (Blueprint $table) {
            $table->id();
            $table->string('entryId')->nullable();
            $table->string('von1')->nullable();
            $table->string('von2')->nullable();
            $table->string('nach1')->nullable();
            $table->string('nach2')->nullable();
            $table->date('umzugdate')->nullable();
            $table->string('zimmer')->nullable();
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
        Schema::dropIfExists('schnellenforms');
    }
};
