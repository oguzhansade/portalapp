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
        Schema::create('firmas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mail')->nullable();
            $table->string('kantons')->nullable();
            $table->string('telefon')->nullable();
            $table->longText('address')->nullable();
            $table->string('contactPerson')->nullable();
            $table->string('website')->nullable();
            $table->integer('counter1')->nullable();
            $table->integer('counter2')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('firmas');
    }
};
