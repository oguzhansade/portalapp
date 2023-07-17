<?php

namespace App\Http\Controllers\front\firma;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        return view('front.firma.index');
    }
    public function create()
    {
        return view('front.firma.create');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token');

        $firma = [
            'name' => $request->firmaName,
            'mail' => $request->firmaMail,
            'counter1' => 0,
            'counter2' => $request->entryLimit,
            'status' => 'Aktif'
        ];
    }
}
