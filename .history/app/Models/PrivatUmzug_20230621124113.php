<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivatUmzug extends Model
{
    protected $fillable = [
        'entryId',
        'strasse',
        'plzOrt',
        'anzahlZimmer',
        'etage',
        'lift',
        'weitere',
        'umzugDate',
        'fullname',
        'email',
        'telefon',
        'bemerkungen',
        'type',
    ];
    
    use HasFactory;
}
