<?php

namespace App\Helper;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use App\Models\FirmenForm;
use App\Models\KontaktForm;
use App\Models\PrivatUmzugForm;
use App\Models\ReinigungForm;
use App\Models\schnellenform;
use App\Models\OfferFirma;
use App\Models\Firma;

class calendarUpdate
{
    static function calendarUpdate($serviceName, $date, $location, $title, $comment, $endDate, $serviceId, $eventId)
    {
        $firmalar = Firma::where('status','Aktif');
        $firmaId = [];
        $sayac = 0;
        $firmaId = $firmalar->pluck('id')->toArray();

        $fileContents = json_encode($firmaId);
        $filePath = storage_path('app/public/Firmalar.txt'); // Dosyanın tam yolu
    
        if (!file_exists($filePath)) {
            touch($filePath); // Dosyayı oluştur
            chmod($filePath, 0666); // Yazma izinlerini ayarla
        }
    
        file_put_contents($filePath, $fileContents);
    }
}