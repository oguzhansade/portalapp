<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontaktForm extends Model
{
    protected $fillable = [
        'entryId',
        'anrede',
        'fullname',
        'mail',
        'telefon',
        'nachricht',
        'type',
    ];
    use HasFactory;
}
