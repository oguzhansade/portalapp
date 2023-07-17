<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    $table->string('name')->nullable();
    $table->string('mail')->nullable();
    $table->integer('counter1')->nullable();
    $table->integer('counter2')->nullable();
    $table->string('status')->nullable();

    protected $fillable = [
        'name',
        'mail',
        'counter1',
        'counter2',
        'status'
    ];
    use HasFactory;
}
