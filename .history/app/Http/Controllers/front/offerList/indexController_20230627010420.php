<?php

namespace App\Http\Controllers\front\offerList;

use App\Http\Controllers\Controller;
use App\Models\Firma;
use App\Models\OfferFirma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class indexController extends Controller
{
    public function index()
    {
        return view('front.offerlist.index');
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
        ->addColumn('option', function ($array) {
            switch ($array['type']) {
                case ('Schnellanfrage');
                if($array->status == 0)
                {
                    return '
                            <button  class="btn btn-sm btn-warning payButton" onClick="payStatusChanger('.$array->status.')">Pasif</button>';
                }
                else {
                    return '
                    <button class="btn btn-sm btn-success payButton" onClick="payStatusChanger('.$array->status.')">Aktif</button>';
                }
                    break;
            }
        })

        ->rawColumns(['option'])
            ->make(true);
        
            $renderedData = (array)$data->original;
            return response()->json($renderedData);
    }

    public function statusChanger ($taskId)
    {
        $task = WorkerBasket::where('id',$taskId)->first();
        if($task['payStatus'] == 0)
        {
            $task = [
                'payStatus' => 1
            ];

            $update = WorkerBasket::where('id',$taskId)->first()->update($task);
        } else if($task['payStatus'] == 1)
        {
            $task = [
                'payStatus' => 0
            ];
            $update = WorkerBasket::where('id',$taskId)->update($task);
        }

        if($update) {
            return response()->json([
                'success' => true,
                'message' => 'Kayıt Güncellendi',
                'task' => WorkerBasket::where('id',$taskId)->first()
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Kayıt Güncellendi',
                'task' => WorkerBasket::where('id',$taskId)->first()
            ]);
        }


    }
}
