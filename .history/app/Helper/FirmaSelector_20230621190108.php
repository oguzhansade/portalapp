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
            $count = OfferFirma::where('firmaId', $id)
                ->whereDate('created_at', '>=', $fiveDaysAgo)
                ->count();

            $offerFirmaCounts[$id] = $count;
        }

        asort($offerFirmaCounts);


        $offerFirmaCounts = array_filter($offerFirmaCounts); // Boş kayıt sayılarından arındırma

        $minCount = min($offerFirmaCounts); // En küçük kayıt sayısını bulma
        $filteredCounts = array_filter($offerFirmaCounts, function($count) use ($minCount) {
            return $count === $minCount;
        });

        $selectedCounts = array_rand($filteredCounts, 5); // 5 adet rastgele indeks seçimi

        $selectedData = [];
        foreach ($selectedCounts as $count) {
            $id = array_keys($filteredCounts)[$count];
            $selectedData[$id] = $offerFirmaCounts[$id];
        }

        $fileContents = json_encode($selectedData);
        $filePath = storage_path('app/public/SeçilmişFirmalar.txt'); // Dosyanın tam yolu
    
        if (!file_exists($filePath)) {
            touch($filePath); // Dosyayı oluştur
            chmod($filePath, 0666); // Yazma izinlerini ayarla
        }
    
        file_put_contents($filePath, $fileContents);
    }
}