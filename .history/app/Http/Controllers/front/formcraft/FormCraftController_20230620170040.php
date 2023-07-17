<?php

namespace App\Http\Controllers\front\formcraft;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormCraftController extends Controller
{
    public function form()
    {
        return view('formcraft.form');
    }
    public function handleFormData(Request $request)
    {
        // // Gelen verileri alın
        $formData = $request->all();
    
        // Verileri dosyaya yazdır
        $fileContents = json_encode($formData);
        $filePath = storage_path('app/public/deneme.txt'); // Dosyanın tam yolu
    
        if (!file_exists($filePath)) {
            touch($filePath); // Dosyayı oluştur
            chmod($filePath, 0666); // Yazma izinlerini ayarla
        }
    
        file_put_contents($filePath, $fileContents);
    
        // İşlem sonucunu döndür
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı ve dosyaya yazıldı.']);
    }
}
