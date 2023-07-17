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
        // Gelen verileri alın
        $formData = $request->all();

        // Verileri dosyaya yazdır
        $fileContents = json_encode($formData);
        file_put_contents('test.txt', $fileContents);

        // İşlem sonucunu döndür
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı ve dosyaya yazıldı.']);
    }
}
