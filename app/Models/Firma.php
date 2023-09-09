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
        'status',
        'kantons',
        'telefon',
        'address',
        'contactPerson',
        'website'
    ];
    use HasFactory;
    static function getFirmaTotal()
    {
        $countRecord = Firma::count();
        return $countRecord;
    }
    static function getInfo($id,$param)
    {
        $data = Firma::where('id',$id)->first();
        return $data[$param];
    }
}
