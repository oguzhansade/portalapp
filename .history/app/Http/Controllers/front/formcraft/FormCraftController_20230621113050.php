<?php

namespace App\Http\Controllers\front\formcraft;

use App\Http\Controllers\Controller;
use App\Models\PrivatumzugForm;
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
        
        $privatUmzug = [
            'entryId' => $formData['Entry_ID'],
            'strasse' => $formData['Strasse/Nr_'],
            'plzOrt' => $formData['PLZ/Ort'],
            'anzahlZimmer' => $formData['Anzahl_Zimmer'],
            'etage' => $formData['Etage'],
            'lift' => $formData['Lift_vorhanden?'],
            'weitere' => $formData['Weitere_Dienstleistungen'],
            'umzugDate' => $formData['Umzugsdatum'],
            'fullname' => $formData['Name_/_Vorname'],
            'email' => $formData['Ihre_E-Mail-Adresse'],
            'telefon' => $formData['Telefon'],
            'bemerkungen' => $formData['Bemerkungen'],
            'type' => 'Privatumzug',
        ];

        PrivatumzugForm::create($privatUmzug);
    
        // İşlem sonucunu döndür
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı ve dosyaya yazıldı.']);
    }

    public function handleKontaktForm(Request $request)
    {
        $formData = $request->all();
        
        
        $fileContents = json_encode($formData);
        $filePath = storage_path('app/public/kontaktform.txt'); // Dosyanın tam yolu
    
        if (!file_exists($filePath)) {
            touch($filePath); // Dosyayı oluştur
            chmod($filePath, 0666); // Yazma izinlerini ayarla
        }
    
        file_put_contents($filePath, $fileContents);
    
        // İşlem sonucunu döndür
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı ve dosyaya yazıldı.']);
    }
}
