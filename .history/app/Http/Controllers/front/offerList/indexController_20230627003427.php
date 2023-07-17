<?php

namespace App\Http\Controllers\front\offerList;

use App\Http\Controllers\Controller;
use App\Models\Firma;
use App\Models\OfferFirma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    public function index()
    {
        return view('front.offerList.index')
    }
    public function data(Request $request)
    {
        $array = [];
        $i = 0;

        $table = DB::table('schnellenforms');
        $table2 = DB::table('reinigung_forms');
        $table3 = DB::table('privat_umzug_forms');
        $table4 = DB::table('firmen_forms');
        $table5 = DB::table('kontakt_forms');

        $tableData = $table->get()->toArray();
        $table2Data = $table2->get()->toArray();
        $table3Data = $table3->get()->toArray();
        $table4Data = $table4->get()->toArray();
        $table5Data = $table5->get()->toArray();
        
        if ($tableData) {
            foreach ($tableData as $k => $v) {
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["offerId"] = $v->entryId;
                $array[$i]["customerName"] = $v->fullname;
                $array[$i]["firma"] = Firma::where('id', OfferFirma::where('offerId', $v->id)->value('firmaId'))->value('name');
                $array[$i]["type"] = $v->type;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["status"] = $v->status;
                $i++;
            }
        }

        $data = DataTables::of($array)
        ->addColumn('option', function ($array) {
            switch ($array['type']) {
                case ('Schnellanfrage');
                    return '
                        <a class="btn btn-sm  btn-primary" href="' . route('firma.index', ['id' => $array['id']]) . '"><i class="feather feather-eye" ></i> Quittung</a> 
                        <a class="btn btn-sm  btn-edit" href="'.route('firma.index',['id'=>$array['id']]).'"><i class="feather feather-edit" ></i> Kunde</a> ';
                    break;
            }
        })

        ->rawColumns(['option'])
            ->make(true);

            $renderedData = (array)$data->original;
            return response()->json($renderedData);
    }
}
