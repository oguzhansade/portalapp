<?php

namespace App\Http\Controllers\front\formcraft;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormCraftController extends Controller
{
    public function handleFormData(Request $request)
    {
        // Gelen verileri inceleyin
        $formData = $request->all();

        // Verileri işleyin veya kaydedin
        // Örnek olarak, verileri veritabanına kaydetme:
        // $savedData = DB::table('form_data')->insert($formData);

        // İşlem sonucunu döndürün
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı.']);
    }
}
