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
            $recordArray = [
                'offerId' => $offerId,
                'firmaId' => $record['firmaId'],
                'type' => $type
            ];
            OfferFirma::create($recordArray);
            $firma = Firma::where('id',$record['firmaId'])->first();
            if($type = 'Schnellanfrage')
            {
                $offer = schnellenform::where('id',$offerId)->first();
                $emailData = [
                    'sub' => 'Camdalio Portal App'.$type,
                    'from' => 'info@camdalio.com',
                    'companyName' => $firma['name'],
                    'email' => $firma['mail'],
                    'entryId' => $offer['entryId'],
                    'von1' => $offer['von1'],
                    'von2' => $offer['von2'],
                    'nach1' => $offer['nach1'],
                    'nach2' => $offer['nach2'],
                    'umzugdate' => $offer['umzugdate'],
                    'zimmer' => $offer['zimmer'],
                    'fullname' => $offer['fullname'],
                    'customerEmail' => $offer['email'],
                    'telefon' => $offer['telefon'],
                    'type' => $offer['type']
                ];
            }
            if($type = 'Reinigung')
            {
                $offer = ReinigungForm::where('id',$offerId)->first();
                $emailData = [
                    'sub' => 'Camdalio Portal App'.$type,
                    'from' => 'info@camdalio.com',
                    'companyName' => $firma['name'],
                    'email' => $firma['mail'],
                    'entryId' => $offer['entryId'],
                    'address' => $offer['address'],
                    'anzahlZimmer' => $offer['anzahlZimmer'],
                    'm2' => $offer['m2'],
                    'reinigungTermin' => $offer['reinigungTermin'],
                    'unternehmen' => $offer['unternehmen'],
                    'anrede' => $offer['anrede'],
                    'fullname' => $offer['fullname'],
                    'customerEmail' => $offer['email'],
                    'telefon' => $offer['telefon'],
                    'type' => $offer['type']
                ];
            }
            
            Mail::to($emailData['email'])->send(new OfferMail($emailData));
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