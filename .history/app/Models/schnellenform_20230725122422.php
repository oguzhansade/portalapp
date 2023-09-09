<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schnellenform extends Model
{
    protected $fillable = [
        'entryId',
        'von1',
        'von2',
        'vonKanton',
        'nach1',
        'nach2',
        'nachKanton',
        'umzugDate',
        'zimmer',
        'fullname' ,
        'email' ,
        'telefon',
        'type',
    ];
    use HasFactory;
}
