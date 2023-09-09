<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmenForm extends Model
{
    protected $fillable = [
        'entryId',
        'vonStrasse',
        'vonPlzOrt',
        'anzahlRaume',
        'vonEtage',
        'vonLift',
        'nachStrasse',
        'nachPlzOrt',
        'nachEtage',
        'umzugDate',
        'nachLift',
        'firma',
        'andrede',
        'fullname',
        'vonKanton',
        'nachKanton',
        'email',
        'telefon',
        'bemerkungen',
        'type',
    ];
    use HasFactory;
}
