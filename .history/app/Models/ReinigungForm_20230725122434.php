<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReinigungForm extends Model
{
    protected $fillable = [
        'entryId',
        'address',
        'anzahlZimmer',
        'm2',
        'reinigungTermin',
        'unternehmen',
        'anrede',
        'fullname',
        'email',
        'telefon',
        'vonKanton',
        'type'
    ];
    use HasFactory;
}
