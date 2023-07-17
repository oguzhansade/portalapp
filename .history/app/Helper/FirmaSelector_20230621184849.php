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

class FirmaSelector
{
    static function FirmaSelector()
    {
        $firmalar = Firma::where('status', 'Aktif')->get();
        $firmaId = $firmalar->pluck('id')->toArray();

        $offerFirmaCounts = [];

        $fiveDaysAgo = Carbon::now()->subDays(5)->toDateString();

        foreach ($firmaId as $id) {
            $count = OfferFirma::where('firma_id', $id)
                ->whereDate('created_at', '>=', $fiveDaysAgo)
                ->count();

            $offerFirmaCounts[$id] = $count;
        }

        
        $fileContents = json_encode($offerFirmaCounts);
        $filePath = storage_path('app/public/Tarihler2.txt'); // Dosyanın tam yolu
    
        if (!file_exists($filePath)) {
            touch($filePath); // Dosyayı oluştur
            chmod($filePath, 0666); // Yazma izinlerini ayarla
        }
    
        file_put_contents($filePath, $fileContents);
    }
}