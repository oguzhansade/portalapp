<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    protected $fillable = [
        'name',
        'mail',
        'counter1',
        'counter2',
        'status'
    ];
    use HasFactory;
    
}
