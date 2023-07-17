<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferFirma extends Model
{
    protected $fillable = [
        'offerId',
        'firmaId',
        'type'
    ];
    use HasFactory;

    static function getOfferTotal()
    {
        $countRecord = OfferFirma::count();
        return $countRecord;
    }
}
