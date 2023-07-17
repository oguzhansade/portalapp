<?php

namespace App\Http\Controllers\front\formcraft;

use App\Http\Controllers\Controller;
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
        $schnellanfrage = [
            'name' => 'Mertcan',
            'surname' => $formData['Nach:_PLZ/_Ort'],
            'age' => $formData['Entry_ID']
        ];
        test::create($schnellanfrage);
        
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı ve dosyaya yazıldı.']);
    }
}
