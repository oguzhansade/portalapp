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
use Illuminate\Support\Facades\Mail;
use App\Mail\OfferMail;


class FirmaSelector
{
    static function FirmaSelector($offerId,$type)
    {
        $firmalar = Firma::where('status', 'Aktif')->get();
        $firmaId = $firmalar->pluck('id')->toArray();
        
        $offerFirmaCounts = [];
        
        $fiveDaysAgo = Carbon::now()->subDays(5)->toDateString();
        
        foreach ($firmaId as $id) {
            $count = OfferFirma::where('firmaId', $id)
                ->whereDate('created_at', '>=', $fiveDaysAgo)
                ->count();
        
            $offerFirmaCounts[] = [
                'firmaId' => $id,
                'records' => $count,
            ];
        }
        
        usort($offerFirmaCounts, function ($a, $b) {
            return $a['records'] - $b['records'];
        });
        
        $selectedOffers = array_slice($offerFirmaCounts, 0, 5);
        foreach($selectedOffers as $record)
        {
            $firmaMailer = Firma::where('id',$record['firmaId'])->first();
            $firmaMail = $firmaMailer['email'];
            $recordArray = [
                'offerId' => $offerId,
                'firmaId' => $record['firmaId'],
                'type' => $type
            ];
            OfferFirma::create($recordArray);
            $firma = Firma::where('id',$record['firmaId'])->first();
            $firmaName = $firma['name'];
            $firmasayac = [
                'counter1' => $firma['counter1'] + 1
            ];
            if($firma['counter2'] <= $firmasayac['counter1']){
                $firma = [
                    'status' => 'Pasif'
                ];
                Firma::where('id',$record['firmaId'])->update($firma);
            };
            $update = Firma::where('id',$record['firmaId'])->update($firmasayac);
            
            
        };
       
        // $fileContents = json_encode($offerFirmaCounts);
        // $filePath = storage_path('app/public/secilenler4.txt'); // Dosyanın tam yolu
    
        // if (!file_exists($filePath)) {
        //     touch($filePath); // Dosyayı oluştur
        //     chmod($filePath, 0666); // Yazma izinlerini ayarla
        // }
    
        // file_put_contents($filePath, $fileContents);
    }
}