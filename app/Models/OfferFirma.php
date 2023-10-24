<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\schnellenform;

class OfferFirma extends Model
{
    protected $fillable = [
        'offerId',
        'firmaId',
        'type',
        'status'
    ];
    use HasFactory;

    static function getOfferTotal()
    {
        $countRecord = OfferFirma::count();
        return $countRecord;
    }

}
