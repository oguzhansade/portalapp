<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schnellenform extends Model
{
    protected $fillable = [
        'entryId',
        'heading',
        'von1',
        'von2',
        'nach1',
        'nach2',
        'umzugDate',
        'zimmer',
        'fullname' ,
        'email' ,
        'telefon',
        'type',
    ];
    use HasFactory;
}
