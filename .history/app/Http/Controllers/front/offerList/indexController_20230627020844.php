<?php

namespace App\Http\Controllers\front\offerList;

use App\Http\Controllers\Controller;
use App\Models\Firma;
use App\Models\FirmenForm;
use App\Models\KontaktForm;
use App\Models\OfferFirma;
use App\Models\PrivatUmzugForm;
use App\Models\ReinigungForm;
use App\Models\schnellenform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class indexController extends Controller
{
    public function index()
    {
        return view('front.offerlist.index');
    }

    public function detail($id, $type) {
        if($type == 'Schnellanfrage')
        {
            $data = schnellenform::where('id',$id)->first();
            return view('front.offerlist.detail',['data' => $data]);
        }
        if($type == 'Reinigung')
        {
            $data = ReinigungForm::where('id',$id)->first();
            return view('front.offerlist.detail',['data' => $data]);
        }
        if($type == 'PrivatUmzug')
        {
            $data = PrivatUmzugForm::where('id',$id)->first();
            return view('front.offerlist.detail',['data' => $data]);
        }
        if($type == 'Firmen')
        {
            $data = FirmenForm::where('id',$id)->first();
            return view('front.offerlist.detail',['data' => $data]);
        }
        if($type == 'Kontakt')
        {
            $data = KontaktForm::where('id',$id)->first();
            return view('front.offerlist.detail',['data' => $data]);
        }
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
                $firmaIds = OfferFirma::where('offerId', $v->id)->pluck('firmaId')->toArray();
                $firmaNames = Firma::whereIn('id', $firmaIds)->pluck('name')->toArray();
                $array[$i]["firma"] = implode(", ", $firmaNames);
                $array[$i]["type"] = $v->type;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["status"] = $v->status;
                $i++;
            }
        }

        if ($table2Data) {
            foreach ($table2Data as $k => $v) {
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["offerId"] = $v->entryId;
                $array[$i]["customerName"] = $v->fullname;
                $firmaIds = OfferFirma::where('offerId', $v->id)->pluck('firmaId')->toArray();
                $firmaNames = Firma::whereIn('id', $firmaIds)->pluck('name')->toArray();
                $array[$i]["firma"] = implode(", ", $firmaNames);
                $array[$i]["type"] = $v->type;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["status"] = $v->status;
                $i++;
            }
        }

        if ($table3Data) {
            foreach ($table3Data as $k => $v) {
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["offerId"] = $v->entryId;
                $array[$i]["customerName"] = $v->fullname;
                $firmaIds = OfferFirma::where('offerId', $v->id)->pluck('firmaId')->toArray();
                $firmaNames = Firma::whereIn('id', $firmaIds)->pluck('name')->toArray();
                $array[$i]["firma"] = implode(", ", $firmaNames);
                $array[$i]["type"] = $v->type;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["status"] = $v->status;
                $i++;
            }
        }

        if ($table4Data) {
            foreach ($table4Data as $k => $v) {
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["offerId"] = $v->entryId;
                $array[$i]["customerName"] = $v->fullname;
                $firmaIds = OfferFirma::where('offerId', $v->id)->pluck('firmaId')->toArray();
                $firmaNames = Firma::whereIn('id', $firmaIds)->pluck('name')->toArray();
                $array[$i]["firma"] = implode(", ", $firmaNames);
                $array[$i]["type"] = $v->type;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["status"] = $v->status;
                $i++;
            }
        }

        if ($table5Data) {
            foreach ($table5Data as $k => $v) {
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["offerId"] = $v->entryId;
                $array[$i]["customerName"] = $v->fullname;
                $firmaIds = OfferFirma::where('offerId', $v->id)->pluck('firmaId')->toArray();
                $firmaNames = Firma::whereIn('id', $firmaIds)->pluck('name')->toArray();
                $array[$i]["firma"] = implode(", ", $firmaNames);
                $array[$i]["type"] = $v->type;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["status"] = $v->status;
                $i++;
            }
        }

        $data = DataTables::of($array)
        ->addColumn('status', function ($array) {
           
                if($array['status'] == 'Pasif')
                {
                    return sprintf('<button class="btn btn-sm btn-warning payButton" onClick="statusChanger(%d, \'%s\')">Pasif</button>', $array['id'], $array['type']);
                }
                else {
                    return sprintf('<button class="btn btn-sm btn-success payButton" onClick="statusChanger(%d, \'%s\')">Aktif</button>', $array['id'], $array['type']);
                }
                   
        })

        ->addColumn('option',function($array) 
        {
            return '<a class="btn btn-sm btn-detail" href="' . route('offerList.detail', ['id' => $array['id'], 'type' => $array['type']]) . '">Detail</a>';
        })

        ->rawColumns(['option','status'])
            ->make(true);
        
            $renderedData = (array)$data->original;
            return response()->json($renderedData);
    }

    public function statusChanger ($offerId, $type)
    {

        
        switch ($type) {
            case ('Schnellanfrage');
                $entry = schnellenform::where('id',$offerId)->first();
                if($entry['status'] == 'Aktif') {
                    $update = schnellenform::where('id',$offerId)->update([
                        'status' => 'Pasif'
                    ]);
                    $update2 = OfferFirma::where('offerId',$offerId)->update([
                        'status' => 'Pasif'
                    ]);
                }
                else {
                    $update = schnellenform::where('id',$offerId)->update([
                        'status' => 'Aktif'
                    ]);
                    $update2 = OfferFirma::where('offerId',$offerId)->update([
                        'status' => 'Aktif'
                    ]);
                }
                
            break;
        }
        

        if($update && $update2) {
            return response()->json([
                'success' => true,
                'message' => 'Kayıt Güncellendi',
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Kayıt Güncellenmedi',
            ]);
        }
    }
}
