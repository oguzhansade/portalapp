<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivatUmzugForm extends Model
{
    protected $fillable = [
        'entryId',
        'vonStrasse',
        'vonPlzOrt',
        'anzahlZimmer',
        'vonEtage',
        'ausLift',
        'weitere',
        'nachStrasse',
        'nachPlzOrt',
        'nachEtage',
        'umzugDate',
        'einLift',
        'anrede',
        'vonKanton',
        'nachKanton',
        'fullname',
        'email',
        'telefon',
        'bemerkungen',
        'type',
    ];
    use HasFactory;
}
