<?php

namespace App\Http\Controllers\front\formcraft;

use App\Http\Controllers\Controller;

use App\Models\PrivatUmzugForm;
use App\Models\schnellenform;
use App\Models\test;
use Illuminate\Http\Request;

class FormCraftController extends Controller
{
    public function form()
    {
        return view('formcraft.form');
    }
    public function handleSchnellanfrageForm(Request $request)
    {
        $formData = $request->all();
        $schnellanFrage = [
            'entryId' => $formData['Entry_ID'],
            'von1' => $formData['Von:_Str_/_Nr_'],
            'von2' => $formData['Von:_PLZ/_Ort'],
            'nach1' => $formData['Nach:_Str_/_Nr_'],
            'nach2' => $formData['Nach:_PLZ/_Ort'],
            'umzugDate' => $formData['Umzugsdatum'],
            'zimmer' => $formData['Zimmer'],
            'fullname' => $formData['Vorname_/_Name'],
            'email' => $formData['Email'],
            'telefon' => $formData['Telefon'],
            'type' => 'Schenllanfrage',
        ];
        schnellenform::create($schnellanFrage);
        
        // $fileContents = json_encode($formData);
        // $filePath = storage_path('app/public/schellanform.txt'); // Dosyanın tam yolu
    
        // if (!file_exists($filePath)) {
        //     touch($filePath); // Dosyayı oluştur
        //     chmod($filePath, 0666); // Yazma izinlerini ayarla
        // }
    
        // file_put_contents($filePath, $fileContents);
    
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı ve dosyaya yazıldı.']);
    }

    public function handlePrivatumzugForm(Request $request)
    {
        $formData = $request->all();
        
        // $fileContents = json_encode($formData);
        // $filePath = storage_path('app/public/primat.txt'); // Dosyanın tam yolu
    
        // if (!file_exists($filePath)) {
        //     touch($filePath); // Dosyayı oluştur
        //     chmod($filePath, 0666); // Yazma izinlerini ayarla
        // }
    
        // file_put_contents($filePath, $fileContents);

        $privatUmzug = [
            'entryId' => $formData['Entry_ID'],
            'vonStrasse' => $formData['Von:_Str_/_Nr_'],
            'vonPlzOrt' => $formData['Von:_PLZ/Ort'],
            'anzahlZimmer' => $formData['Anzahl_Zimmer'],
            'vonEtage' => $formData['Von:_Etage'],
            'ausLift' => $formData['Von:_Lift_vorhanden?'],
            'weitere' => $formData['Weitere_Dienstleistungen'],
            'nachStrasse' => $formData['Nach:_Str_/_Nr_'],
            'nachPlzOrt' => $formData['Nach:_PLZ/Ort'],
            'nachEtage' => $formData['Nach:_Etage'],
            'umzugDate' => $formData['Umzugsdatum'],
            'einLift' => $formData['Nach:_Lift_vorhanden?'],
            'anrede' => $formData['Anrede'],
            'fullname' => $formData['Name_/_Vorname'],
            'email' => $formData['Ihre_E-Mail-Adresse'],
            'telefon'=> $formData['Telefon'],
            'bemerkungen' => $formData['Bemerkungen'],
            'type' => 'PrivatUmzug',
        ];

        PrivatUmzugForm::create($privatUmzug);

        // İşlem sonucunu döndür
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı ve dosyaya yazıldı.']);
    }

    public function handleReinigungForm(Request $request)
    {
        $formData = $request->all();
        
        $reinigungForm = [
            'entryId' => $formData['Entry_ID'],
            'address' => $formData['Adresse_(Strasse/PLZ/Ort):'],
            'anzahlZimmer' => $formData['Anzahl_Zimmer_/_Räume'],
            'm2' => $formData['Grösse_in_m2'],
            'reinigungTermin' => $formData['Reinigungstermin'],
            'unternehmen' => $formData['Unternehmen'],
            'anrede' => $formData['Anrede'],
            'fullname' => $formData['Name_/_Vorname'],
            'email' => $formData['Ihre_E-Mail-Adresse'],
            'telefon' => $formData['Telefon'],
            'type' => 'Reinigung'
        ];
        
        // $fileContents = json_encode($formData);
        // $filePath = storage_path('app/public/reinigungform.txt'); // Dosyanın tam yolu
    
        // if (!file_exists($filePath)) {
        //     touch($filePath); // Dosyayı oluştur
        //     chmod($filePath, 0666); // Yazma izinlerini ayarla
        // }
    
        // file_put_contents($filePath, $fileContents);
    
        // İşlem sonucunu döndür
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı ve dosyaya yazıldı.']);
    }

    public function handleKontaktForm(Request $request)
    {
        $formData = $request->all();
        
        
        $fileContents = json_encode($formData);
        $filePath = storage_path('app/public/reinigungform.txt'); // Dosyanın tam yolu
    
        if (!file_exists($filePath)) {
            touch($filePath); // Dosyayı oluştur
            chmod($filePath, 0666); // Yazma izinlerini ayarla
        }
    
        file_put_contents($filePath, $fileContents);
    
        // İşlem sonucunu döndür
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı ve dosyaya yazıldı.']);
    }
}
