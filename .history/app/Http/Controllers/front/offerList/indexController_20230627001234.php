<?php

namespace App\Http\Controllers\front\offerList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    public function data(Request $request)
    {
        $array = [];
        $i = 0;

        $table = DB::table('schnellenforms');
        $table2 = DB::table('reinigung_forms');
        $table3 = DB::table('privat_umzug_forms');
        $table4 = DB::table('firmen_forms');
        $table5 = DB::table('kontakt_forms');
    }
}
