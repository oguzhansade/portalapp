<?php

namespace App\Helper;

use App\Mail\CustomerMail;
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
    static function FirmaSelector($offerId,$type,$kanton)
    {
        if($kanton == 'Kontakt')
        {
            $firmalar = Firma::where('status', 'Aktif')->get();
        }
        $firmalar = Firma::where('status', 'Aktif')->where('kantons', 'LIKE', '%'.$kanton.'%')->get();
        $firmaId = $firmalar->pluck('id')->toArray();
        
     

        $offerFirmaCounts = [];
        
        $fiveDaysAgo = Carbon::now()->subDays(2)->toDateString();
        
        foreach ($firmaId as $id) {
            $count = OfferFirma::where('firmaId', $id)->where('status','Aktif')
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

        $fileContents = json_encode($selectedOffers);
        $filePath = storage_path('app/public/Suzgecc1.txt'); // Dosyanın tam yolu
    
        if (!file_exists($filePath)) {
            touch($filePath); // Dosyayı oluştur
            chmod($filePath, 0666); // Yazma izinlerini ayarla
        }
    
        file_put_contents($filePath, $fileContents);

        foreach($selectedOffers as $record)
        {
            $recordArray = [
                'offerId' => $offerId,
                'firmaId' => $record['firmaId'],
                'type' => $type
            ];
            OfferFirma::create($recordArray);

            

            $firma = Firma::where('id',$record['firmaId'])->first();
            if($type == 'Schnellanfrage')
            {
                $offer = schnellenform::where('id',$offerId)->first();
                $emailData = [
                    'sub' => 'Neue Anfrage: Schnellanfrage',
                    'from' => 'info@umzugspreisvergleich.ch',
                    'companyName' => 'Umzugspreisvergleich.ch',
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
                    'type' => $offer['type'],
                    'created_at' => $offer['created_at']
                ];
            }
            if($type == 'Reinigung')
            {
                $offer = ReinigungForm::where('id',$offerId)->first();
                $emailData = [
                    'sub' => ' Neue Anfrage: Reinigung',
                    'from' => 'info@umzugspreisvergleich.ch',
                    'companyName' => 'Umzugspreisvergleich.ch',
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
                    'type' => $offer['type'],
                    'created_at' => $offer['created_at']
                ];
            }

            if($type == 'PrivatUmzug')
            {
                $offer = PrivatUmzugForm::where('id',$offerId)->first();
                $emailData = [
                    'sub' => 'Neue Anfrage: Anfrage für Privatumzug',
                    'from' => 'info@umzugspreisvergleich.ch',
                    'companyName' => 'Umzugspreisvergleich.ch',
                    'email' => $firma['mail'],
                    'entryId' => $offer['entryId'],
                    'vonStrasse' => $offer['vonStrasse'],
                    'vonPlzOrt' => $offer['vonPlzOrt'],
                    'anzahlZimmer' => $offer['anzahlZimmer'],
                    'vonEtage' => $offer['vonEtage'],
                    'ausLift' => $offer['ausLift'],
                    'weitere' => $offer['weitere'],
                    'nachStrasse' => $offer['nachStrasse'],
                    'nachPlzOrt' => $offer['nachPlzOrt'],
                    'nachEtage' => $offer['nachEtage'],
                    'umzugDate' => $offer['umzugDate'],
                    'einLift' => $offer['einLift'],
                    'anrede' => $offer['anrede'],
                    'fullname' => $offer['fullname'],
                    'customerEmail' => $offer['email'],
                    'telefon' => $offer['telefon'],
                    'bemerkungen' => $offer['bemerkungen'],
                    'type' => $offer['type'],
                    'created_at' => $offer['created_at']
                ];
            }

            if($type == 'Firmen')
            {
                $offer = FirmenForm::where('id',$offerId)->first();
                $emailData = [
                    'sub' => 'Neue Anfrage: Anfrage für Geschäftsumzug',
                    'from' => 'info@umzugspreisvergleich.ch',
                    'companyName' => 'Umzugspreisvergleich.ch',
                    'email' => $firma['mail'],
                    'entryId' => $offer['entryId'],
                    'vonStrasse' => $offer['vonStrasse'],
                    'vonPlzOrt' => $offer['vonPlzOrt'],
                    'anzahlRaume' => $offer['anzahlRaume'],
                    'vonEtage' => $offer['vonEtage'],
                    'vonLift' => $offer['vonLift'],
                    'nachStrasse' => $offer['nachStrasse'],
                    'nachPlzOrt' => $offer['nachPlzOrt'],
                    'nachEtage' => $offer['nachEtage'],
                    'umzugDate' => $offer['umzugDate'],
                    'nachLift' => $offer['nachLift'],
                    'firma' => $offer['firma'],
                    'anrede' => $offer['andrede'],
                    'fullname' => $offer['fullname'],
                    'customerEmail' => $offer['email'],
                    'telefon' => $offer['telefon'],
                    'bemerkungen' => $offer['bemerkungen'],
                    'type' => $offer['type'],
                    'created_at' => $offer['created_at']
                ];
            }

            if($type == 'Kontakt')
            {
                $offer = KontaktForm::where('id',$offerId)->first();
                $emailData = [
                    'sub' => 'Neue Anfrage: Kontaktaufnahme-Anfrage',
                    'from' => 'info@umzugspreisvergleich.ch',
                    'companyName' => 'Umzugspreisvergleich.ch',
                    'email' => $firma['mail'],
                    'entryId' => $offer['entryId'],
                    'anrede' => $offer['anrede'],
                    'fullname' => $offer['fullname'],
                    'customerEmail' => $offer['mail'],
                    'telefon' => $offer['telefon'],
                    'nachricht' => $offer['nachricht'],
                    'type' => $offer['type'],
                    'created_at' => $offer['created_at']
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
       
        $offers = array_map(function ($item) {
            unset($item['records']);
            return $item;
        }, $selectedOffers);
        

        if($type == 'Schnellanfrage')
        {
            $form = schnellenform::where('id',$offerId)->first();
            $customerName = $form['fullname'];
            $customerMail = $form['email'];
            $entryId = $form['entryId'];
        }

        $newOffers = array_map(function ($offer) {
            $firmaId = $offer['firmaId'];
        
            // Firma modelinden ilgili firma bilgilerini çekelim
            $firma = Firma::find($firmaId);
        
            // Yeni bir öğe oluşturup istediğimiz alanları atayalım
            return [
                'name' => $firma->name,
                'mail' => $firma->mail,
                'telefon' => $firma->telefon,
                'address' => $firma->address,
                'contactPerson' => $firma->contactPerson
            ];
        }, $offers);

        // $fileContents = json_encode($newOffers);
        // $filePath = storage_path('app/public/testDizi.txt'); // Dosyanın tam yolu
    
        // if (!file_exists($filePath)) {
        //     touch($filePath); // Dosyayı oluştur
        //     chmod($filePath, 0666); // Yazma izinlerini ayarla
        // }
    
        // file_put_contents($filePath, $fileContents);

        $customerMailData = [
            'sub' => 'Ihre Offertanfrage auf umzugspreisvergleich.ch',
            'from' => 'info@umzugpreisvergleich.ch',
            'companyName' => 'Umzugspreisvergleich',
            'customerName' => $customerName,
            'customerMail' => $customerMail,
            'entryId' => $entryId,
            'firmas' => $newOffers,
            'offerId' => $offerId,
            'type' => $type,
            'offer' => $form,
        ];
        
        Mail::to($customerMail)->send(new CustomerMail($customerMailData));

        
    }
}