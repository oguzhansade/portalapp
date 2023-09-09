<?php

namespace App\Http\Controllers\front\offerList;

use App\Http\Controllers\Controller;
use App\Mail\OfferStatusNotify;
use App\Models\Firma;
use App\Models\FirmenForm;
use App\Models\OfferFirma;
use App\Models\PrivatUmzugForm;
use App\Models\ReinigungForm;
use App\Models\schnellenform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;

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
    }
    public function data(Request $request)
    {
        $array = [];
        $i = 0;
        
        $table = DB::table('schnellenforms');
        $table2 = DB::table('reinigung_forms');
        $table3 = DB::table('privat_umzug_forms');
        $table4 = DB::table('firmen_forms');

        
        // Minimum date filter
        if($request->min_date) {
            $table->whereDate('created_at', '>=', $request->min_date);
            $table2->whereDate('created_at', '>=', $request->min_date);
            $table3->whereDate('created_at', '>=', $request->min_date);
            $table4->whereDate('created_at', '>=', $request->min_date);
        }
        
        // Maximum date filter
        if($request->max_date) {
            $table->whereDate('created_at', '<=', $request->max_date);
            $table2->whereDate('created_at', '<=', $request->max_date);
            $table3->whereDate('created_at', '<=', $request->max_date);
            $table4->whereDate('created_at', '<=', $request->max_date);
        }

        
        if($request->status) {
            if($request->status == 'Aktif')
            {
                $table->where('status', 'Aktif');
                $table2->where('status', 'Aktif');
                $table3->where('status', 'Aktif');
                $table4->where('status', 'Aktif');
            }
            else if($request->status == 'Pasif')
            {
                $table->where('status', 'Pasif');
                $table2->where('status', 'Pasif');
                $table3->where('status', 'Pasif');
                $table4->where('status', 'Pasif');
            }
            else if ($request->status == 'Alle') {
                
            }
        }
        if ($request->zimmerFilter) {
            $zimmerFilter = $request->zimmerFilter;
        
            // Eğer $zimmerFilter, birden fazla değer içeren bir dizi ise, 'whereIn' kullanın:
            if (is_array($zimmerFilter)) {
                $table->whereIn('zimmer', $zimmerFilter);
                $table2->whereIn('anzahlZimmer', $zimmerFilter);
                $table3->whereIn('anzahlZimmer', $zimmerFilter);
                $table4->whereIn('anzahlRaume', $zimmerFilter);
            } else {
                // Eğer $zimmerFilter, tek bir değerse 'where' kullanın:
                $table->where('zimmer', $zimmerFilter);
                $table2->where('anzahlZimmer', $zimmerFilter);
                $table3->where('anzahlZimmer', $zimmerFilter);
                $table4->where('anzahlRaume', $zimmerFilter);
            }
        }

        $tableData = $table->get()->toArray();
        $table2Data = $table2->get()->toArray();
        $table3Data = $table3->get()->toArray();
        $table4Data = $table4->get()->toArray();
        
        if ($tableData) {
            foreach ($tableData as $k => $v) {
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["offerId"] = $v->entryId;
                $array[$i]["customerName"] = $v->fullname;
                $firmaIds = OfferFirma::where('offerId', $v->id)->where('type','Schnellanfrage')->pluck('firmaId')->toArray();
                $firmaNames = Firma::whereIn('id', $firmaIds)->pluck('name')->toArray();
                $array[$i]["firma"] = implode(", ", $firmaNames);
                $array[$i]["type"] = $v->type;
                $array[$i]["zimmer"] = $v->zimmer;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["status"] = $v->status;
                $array[$i]["canceled"]= $v->canceled;
                $i++;
            }
        }

        if ($table2Data) {
            foreach ($table2Data as $k => $v) {
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["offerId"] = $v->entryId;
                $array[$i]["customerName"] = $v->fullname;
                $firmaIds = OfferFirma::where('offerId', $v->id)->where('type','Reinigung')->pluck('firmaId')->toArray();
                $firmaNames = Firma::whereIn('id', $firmaIds)->pluck('name')->toArray();
                $array[$i]["firma"] = implode(", ", $firmaNames);
                $array[$i]["type"] = $v->type;
                $array[$i]["zimmer"] = $v->anzahlZimmer;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["status"] = $v->status;
                $array[$i]["canceled"]= $v->canceled;
                $i++;
            }
        }

        if ($table3Data) {
            foreach ($table3Data as $k => $v) {
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["offerId"] = $v->entryId;
                $array[$i]["customerName"] = $v->fullname;
                $firmaIds = OfferFirma::where('offerId', $v->id)->where('type','PrivatUmzug')->pluck('firmaId')->toArray();
                $firmaNames = Firma::whereIn('id', $firmaIds)->pluck('name')->toArray();
                $array[$i]["firma"] = implode(", ", $firmaNames);
                $array[$i]["type"] = $v->type;
                $array[$i]["zimmer"] = $v->anzahlZimmer;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["status"] = $v->status;
                $array[$i]["canceled"]= $v->canceled;
                $i++;
            }
        }

        if ($table4Data) {
            foreach ($table4Data as $k => $v) {
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["offerId"] = $v->entryId;
                $array[$i]["customerName"] = $v->fullname;
                $firmaIds = OfferFirma::where('offerId', $v->id)->where('type','Firmen')->pluck('firmaId')->toArray();
                $firmaNames = Firma::whereIn('id', $firmaIds)->pluck('name')->toArray();
                $array[$i]["firma"] = implode(", ", $firmaNames);
                $array[$i]["type"] = $v->type;
                $array[$i]["zimmer"] = $v->anzahlRaume;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["status"] = $v->status;
                $array[$i]["canceled"]= $v->canceled;
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
        ->addColumn('cancel', function ($array) {
            
                if($array['canceled'] == 0)
                {
                    return sprintf('<button class="btn btn-sm btn-primary payButton" onClick="cancelOffer(%d, \'%s\')">Cancel</button>', $array['id'], $array['type']);
                }
                else {
                    return sprintf('<button class="btn btn-sm btn-danger payButton" onClick="cancelOffer(%d, \'%s\')">Canceled</button>', $array['id'], $array['type']);
                }
               
        })

        ->addColumn('option',function($array) 
        {
            return '<a class="btn btn-sm btn-detail" href="' . route('offerList.detail', ['id' => $array['id'], 'type' => $array['type']]) . '">Detail</a>';
        })

        ->rawColumns(['option','status','cancel'])
            ->make(true);   
            
            
            $t1 = schnellenform::all()->count();
            $t2 = PrivatUmzugForm::all()->count();
            $t3 = FirmenForm::all()->count();
            $t4 = ReinigungForm::all()->count();
            $toplamTumVeri = $t1 + $t2 + $t3 + $t4;
            $renderedData = (array)$data->original;
            $renderedData['pasifTotal'] = count(array_filter($array, function($item) {
                return $item['status'] == 'Pasif';
            }));
            $renderedData['aktifTotal'] = count(array_filter($array, function($item) {
                return $item['status'] == 'Aktif';
            }));
            $renderedData['toplamTeklif'] =  $toplamTumVeri;     
            return response()->json($renderedData);
    }

    public function statusChanger ($offerId, $type)
    {

        
        switch ($type) {
            case 'Schnellanfrage':
                $entry = schnellenform::where('id', $offerId)->first();
                if ($entry['status'] == 'Aktif') {
                    $update = schnellenform::where('id', $offerId)->update([
                        'status' => 'Pasif'
                    ]);
                    $update2 = OfferFirma::where('offerId', $offerId)->update([
                        'status' => 'Pasif'
                    ]);
                    $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                    foreach ($getOFirmas as $getOFirma) {
                        $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                        $form = schnellenform::where('id',$offerId)->first();
                        if($firmas['mail'])
                        {
                            $emailData = [
                                'sub' => $offerId.' '.'Numaralı Teklif İptal Edildi',
                                'from' => 'info@umzugspreisvergleich.ch',
                                'companyName' => 'Umzugspreisvergleich.ch',
                                'offer' => $form,
                                'type' => $type
                            ];
                            Mail::to($firmas['mail'])->send(new OfferStatusNotify($emailData));
                        }
                        $update3 = Firma::where('id', $firmas->id)->update([
                            'counter1' => $firmas->counter1 - 1
                        ]);
                        $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                        if ($firmas2->counter1 < $firmas2->counter2) {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Aktif'
                            ]);
                        } else {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Pasif'
                            ]);
                        }
                    }
                } else {
                    $update = schnellenform::where('id', $offerId)->update([
                        'status' => 'Aktif'
                    ]);
                    $update2 = OfferFirma::where('offerId', $offerId)->update([
                        'status' => 'Aktif'
                    ]);
                    $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                    foreach ($getOFirmas as $getOFirma) {
                        $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                        $update3 = Firma::where('id', $firmas->id)->update([
                            'counter1' => $firmas->counter1 + 1
                        ]);
                        $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                        if ($firmas2->counter1 < $firmas2->counter2) {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Aktif'
                            ]);
                        } else {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Pasif'
                            ]);
                        }
                    }
                }
                break;
            

            case ('Reinigung');
                $entry = ReinigungForm::where('id',$offerId)->first();
                if($entry['status'] == 'Aktif') {
                    $update = ReinigungForm::where('id',$offerId)->update([
                        'status' => 'Pasif'
                    ]);
                    $update2 = OfferFirma::where('offerId',$offerId)->update([
                        'status' => 'Pasif'
                    ]);

                    $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                    foreach ($getOFirmas as $getOFirma) {
                        $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                        $form = ReinigungForm::where('id',$offerId)->first();
                        if($firmas['mail'])
                        {
                            $emailData = [
                                'sub' => $offerId.' '.'Numaralı Teklif İptal Edildi',
                                'from' => 'info@umzugspreisvergleich.ch',
                                'companyName' => 'Umzugspreisvergleich.ch',
                                'offer' => $form,
                                'type' => $type
                            ];
                            Mail::to($firmas['mail'])->send(new OfferStatusNotify($emailData));
                        }
                        $update3 = Firma::where('id', $firmas->id)->update([
                            'counter1' => $firmas->counter1 - 1
                        ]);
                        $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                        if ($firmas2->counter1 < $firmas2->counter2) {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Aktif'
                            ]);
                        } else {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Pasif'
                            ]);
                        }
                    }
                }
                else {
                    $update = ReinigungForm::where('id',$offerId)->update([
                        'status' => 'Aktif'
                    ]);
                    $update2 = OfferFirma::where('offerId',$offerId)->update([
                        'status' => 'Aktif'
                    ]);

                    $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                    foreach ($getOFirmas as $getOFirma) {
                        $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                        $update3 = Firma::where('id', $firmas->id)->update([
                            'counter1' => $firmas->counter1 + 1
                        ]);
                        $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                        if ($firmas2->counter1 < $firmas2->counter2) {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Aktif'
                            ]);
                        } else {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Pasif'
                            ]);
                        }
                    }
                }
            break;

            case ('PrivatUmzug');
                $entry = PrivatUmzugForm::where('id',$offerId)->first();
                if($entry['status'] == 'Aktif') {
                    $update = PrivatUmzugForm::where('id',$offerId)->update([
                        'status' => 'Pasif'
                    ]);
                    $update2 = OfferFirma::where('offerId',$offerId)->update([
                        'status' => 'Pasif'
                    ]);

                    $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                    foreach ($getOFirmas as $getOFirma) {
                        $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                        $form = PrivatUmzugForm::where('id',$offerId)->first();
                        if($firmas['mail'])
                        {
                            $emailData = [
                                'sub' => $offerId.' '.'Numaralı Teklif İptal Edildi',
                                'from' => 'info@umzugspreisvergleich.ch',
                                'companyName' => 'Umzugspreisvergleich.ch',
                                'offer' => $form,
                                'type' => $type
                            ];
                            Mail::to($firmas['mail'])->send(new OfferStatusNotify($emailData));
                        }
                        $update3 = Firma::where('id', $firmas->id)->update([
                            'counter1' => $firmas->counter1 - 1
                        ]);
                        $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                        if ($firmas2->counter1 < $firmas2->counter2) {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Aktif'
                            ]);
                        } else {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Pasif'
                            ]);
                        }
                    }
                }
                else {
                    $update = PrivatUmzugForm::where('id',$offerId)->update([
                        'status' => 'Aktif'
                    ]);
                    $update2 = OfferFirma::where('offerId',$offerId)->update([
                        'status' => 'Aktif'
                    ]);

                    $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                    foreach ($getOFirmas as $getOFirma) {
                        $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                        $update3 = Firma::where('id', $firmas->id)->update([
                            'counter1' => $firmas->counter1 + 1
                        ]);
                        $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                        if ($firmas2->counter1 < $firmas2->counter2) {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Aktif'
                            ]);
                        } else {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Pasif'
                            ]);
                        }
                    }
                }
            break;

            case ('Firmen');
                $entry = FirmenForm::where('id',$offerId)->first();
                if($entry['status'] == 'Aktif') {
                    $update = FirmenForm::where('id',$offerId)->update([
                        'status' => 'Pasif'
                    ]);
                    $update2 = OfferFirma::where('offerId',$offerId)->update([
                        'status' => 'Pasif'
                    ]);

                    $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                    foreach ($getOFirmas as $getOFirma) {
                        $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                        $form = FirmenForm::where('id',$offerId)->first();
                        if($firmas['mail'])
                        {
                            $emailData = [
                                'sub' => $offerId.' '.'Numaralı Teklif İptal Edildi',
                                'from' => 'info@umzugspreisvergleich.ch',
                                'companyName' => 'Umzugspreisvergleich.ch',
                                'offer' => $form,
                                'type' => $type
                            ];
                            Mail::to($firmas['mail'])->send(new OfferStatusNotify($emailData));
                        }
                        $update3 = Firma::where('id', $firmas->id)->update([
                            'counter1' => $firmas->counter1 - 1
                        ]);
                        $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                        if ($firmas2->counter1 < $firmas2->counter2) {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Aktif'
                            ]);
                        } else {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Pasif'
                            ]);
                        }
                    }
                }
                else {
                    $update = FirmenForm::where('id',$offerId)->update([
                        'status' => 'Aktif'
                    ]);
                    $update2 = OfferFirma::where('offerId',$offerId)->update([
                        'status' => 'Aktif'
                    ]);

                    $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                    foreach ($getOFirmas as $getOFirma) {
                        $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                        $update3 = Firma::where('id', $firmas->id)->update([
                            'counter1' => $firmas->counter1 + 1
                        ]);
                        $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                        if ($firmas2->counter1 < $firmas2->counter2) {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Aktif'
                            ]);
                        } else {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Pasif'
                            ]);
                        }
                    }
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

    public function cancelOffer (Request $request)
    {
        $type = $request->route('type');
        $offerId = $request->route('id');
        switch ($type) {
            case 'Schnellanfrage':
                $entry = schnellenform::where('id', $offerId)->first();
                if ($entry['canceled'] == 0) {
                    $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                    $update = schnellenform::where('id', $offerId)->update([
                        'canceled' => 1,
                    ]);

                    if($entry['status'] == 'Aktif') {
                        $update5 = schnellenform::where('id', $offerId)->update([
                            'status' => 'Pasif',
                        ]);
                        $update2 = OfferFirma::where('offerId', $offerId)->update([
                            'status' => 'Pasif'
                        ]);
                    }

                    foreach ($getOFirmas as $getOFirma) {
                        $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                        $form = schnellenform::where('id',$offerId)->first();
                        if($firmas['mail'])
                        {
                            $emailData = [
                                'sub' => $form['entryId'].' '.'Numaralı Teklif İptal Edildi',
                                'from' => 'info@umzugspreisvergleich.ch',
                                'companyName' => 'Umzugspreisvergleich.ch',
                                'offer' => $form,
                                'type' => $type,
                                'canceled' => $form['canceled']
                            ];
                            Mail::to($firmas['mail'])->send(new OfferStatusNotify($emailData));
                        }
                        if($entry['status'] == 'Aktif') {
                            $update3 = Firma::where('id', $firmas->id)->update([
                                'counter1' => $firmas->counter1 - 1
                            ]);
                        }
                        $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                        if ($firmas2->counter1 < $firmas2->counter2) {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Aktif'
                            ]);
                        } else {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Pasif'
                            ]);
                        }
                    }
                    
                    
                    
                } else {
                    $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                    $update = schnellenform::where('id', $offerId)->update([
                        'canceled' => 0,
                    ]);
                    foreach ($getOFirmas as $getOFirma) {
                        $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                        $form = schnellenform::where('id',$offerId)->first();
                        
                        if($entry['status'] == 'Pasif') {
                            $update5 = schnellenform::where('id', $offerId)->update([
                                'status' => 'Aktif',
                            ]);
                            $update2 = OfferFirma::where('offerId', $offerId)->update([
                                'status' => 'Aktif'
                            ]);
                        }
                        if($firmas['mail'])
                        {
                            $emailData = [
                                'sub' => $form['entryId'].' '.'Numaralı Teklif Onaylandı',
                                'from' => 'info@umzugspreisvergleich.ch',
                                'companyName' => 'Umzugspreisvergleich.ch',
                                'offer' => $form,
                                'type' => $type,
                                'canceled' => $form['canceled']
                            ];
                            Mail::to($firmas['mail'])->send(new OfferStatusNotify($emailData));
                        }
                        if($entry['status'] == 'Pasif') {
                            $update3 = Firma::where('id', $firmas->id)->update([
                                'counter1' => $firmas->counter1 + 1
                            ]);
                        }
                        $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                        if ($firmas2->counter1 < $firmas2->counter2) {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Aktif'
                            ]);
                        } else {
                            $update4 = Firma::where('id', $firmas2->id)->update([
                                'status' => 'Pasif'
                            ]);
                        }
                    }
                }
                break;

                case 'PrivatUmzug':
                    $entry = PrivatUmzugForm::where('id', $offerId)->first();
                    if ($entry['canceled'] == 0) {
                        $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                        $update = PrivatUmzugForm::where('id', $offerId)->update([
                            'canceled' => 1,
                        ]);
    
                        if($entry['status'] == 'Aktif') {
                            $update5 = PrivatUmzugForm::where('id', $offerId)->update([
                                'status' => 'Pasif',
                            ]);
                            $update2 = OfferFirma::where('offerId', $offerId)->update([
                                'status' => 'Pasif'
                            ]);
                        }
    
                        foreach ($getOFirmas as $getOFirma) {
                            $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                            $form = PrivatUmzugForm::where('id',$offerId)->first();
                            if($firmas['mail'])
                            {
                                $emailData = [
                                    'sub' => $form['entryId'].' '.'Numaralı Teklif İptal Edildi',
                                    'from' => 'info@umzugspreisvergleich.ch',
                                    'companyName' => 'Umzugspreisvergleich.ch',
                                    'offer' => $form,
                                    'type' => $type,
                                    'canceled' => $form['canceled']
                                ];
                                Mail::to($firmas['mail'])->send(new OfferStatusNotify($emailData));
                            }
                            if($entry['status'] == 'Aktif') {
                                $update3 = Firma::where('id', $firmas->id)->update([
                                    'counter1' => $firmas->counter1 - 1
                                ]);
                            }
                            $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                            if ($firmas2->counter1 < $firmas2->counter2) {
                                $update4 = Firma::where('id', $firmas2->id)->update([
                                    'status' => 'Aktif'
                                ]);
                            } else {
                                $update4 = Firma::where('id', $firmas2->id)->update([
                                    'status' => 'Pasif'
                                ]);
                            }
                        }
                        
                        
                        
                    } else {
                        $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                        $update = PrivatUmzugForm::where('id', $offerId)->update([
                            'canceled' => 0,
                        ]);
                        foreach ($getOFirmas as $getOFirma) {
                            $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                            $form = PrivatUmzugForm::where('id',$offerId)->first();
                            
                            if($entry['status'] == 'Pasif') {
                                $update5 = PrivatUmzugForm::where('id', $offerId)->update([
                                    'status' => 'Aktif',
                                ]);
                                $update2 = OfferFirma::where('offerId', $offerId)->update([
                                    'status' => 'Aktif'
                                ]);
                            }
                            if($firmas['mail'])
                            {
                                $emailData = [
                                    'sub' => $form['entryId'].' '.'Numaralı Teklif Onaylandı',
                                    'from' => 'info@umzugspreisvergleich.ch',
                                    'companyName' => 'Umzugspreisvergleich.ch',
                                    'offer' => $form,
                                    'type' => $type,
                                    'canceled' => $form['canceled']
                                ];
                                Mail::to($firmas['mail'])->send(new OfferStatusNotify($emailData));
                            }
                            if($entry['status'] == 'Pasif') {
                                $update3 = Firma::where('id', $firmas->id)->update([
                                    'counter1' => $firmas->counter1 + 1
                                ]);
                            }
                            $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                            if ($firmas2->counter1 < $firmas2->counter2) {
                                $update4 = Firma::where('id', $firmas2->id)->update([
                                    'status' => 'Aktif'
                                ]);
                            } else {
                                $update4 = Firma::where('id', $firmas2->id)->update([
                                    'status' => 'Pasif'
                                ]);
                            }
                        }
                    }
                    break;

                    case 'Reinigung':
                        $entry = ReinigungForm::where('id', $offerId)->first();
                        if ($entry['canceled'] == 0) {
                            $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                            $update = ReinigungForm::where('id', $offerId)->update([
                                'canceled' => 1,
                            ]);
        
                            if($entry['status'] == 'Aktif') {
                                $update5 = ReinigungForm::where('id', $offerId)->update([
                                    'status' => 'Pasif',
                                ]);
                                $update2 = OfferFirma::where('offerId', $offerId)->update([
                                    'status' => 'Pasif'
                                ]);
                            }
        
                            foreach ($getOFirmas as $getOFirma) {
                                $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                                $form = ReinigungForm::where('id',$offerId)->first();
                                if($firmas['mail'])
                                {
                                    $emailData = [
                                        'sub' => $form['entryId'].' '.'Numaralı Teklif İptal Edildi',
                                        'from' => 'info@umzugspreisvergleich.ch',
                                        'companyName' => 'Umzugspreisvergleich.ch',
                                        'offer' => $form,
                                        'type' => $type,
                                        'canceled' => $form['canceled']
                                    ];
                                    Mail::to($firmas['mail'])->send(new OfferStatusNotify($emailData));
                                }
                                if($entry['status'] == 'Aktif') {
                                    $update3 = Firma::where('id', $firmas->id)->update([
                                        'counter1' => $firmas->counter1 - 1
                                    ]);
                                }
                                $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                                if ($firmas2->counter1 < $firmas2->counter2) {
                                    $update4 = Firma::where('id', $firmas2->id)->update([
                                        'status' => 'Aktif'
                                    ]);
                                } else {
                                    $update4 = Firma::where('id', $firmas2->id)->update([
                                        'status' => 'Pasif'
                                    ]);
                                }
                            }
                            
                            
                            
                        } else {
                            $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                            $update = ReinigungForm::where('id', $offerId)->update([
                                'canceled' => 0,
                            ]);
                            foreach ($getOFirmas as $getOFirma) {
                                $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                                $form = ReinigungForm::where('id',$offerId)->first();
                                
                                if($entry['status'] == 'Pasif') {
                                    $update5 = ReinigungForm::where('id', $offerId)->update([
                                        'status' => 'Aktif',
                                    ]);
                                    $update2 = OfferFirma::where('offerId', $offerId)->update([
                                        'status' => 'Aktif'
                                    ]);
                                }
                                if($firmas['mail'])
                                {
                                    $emailData = [
                                        'sub' => $form['entryId'].' '.'Numaralı Teklif Onaylandı',
                                        'from' => 'info@umzugspreisvergleich.ch',
                                        'companyName' => 'Umzugspreisvergleich.ch',
                                        'offer' => $form,
                                        'type' => $type,
                                        'canceled' => $form['canceled']
                                    ];
                                    Mail::to($firmas['mail'])->send(new OfferStatusNotify($emailData));
                                }
                                if($entry['status'] == 'Pasif') {
                                    $update3 = Firma::where('id', $firmas->id)->update([
                                        'counter1' => $firmas->counter1 + 1
                                    ]);
                                }
                                $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                                if ($firmas2->counter1 < $firmas2->counter2) {
                                    $update4 = Firma::where('id', $firmas2->id)->update([
                                        'status' => 'Aktif'
                                    ]);
                                } else {
                                    $update4 = Firma::where('id', $firmas2->id)->update([
                                        'status' => 'Pasif'
                                    ]);
                                }
                            }
                        }
                        break;
                        case 'Firmen':
                            $entry = FirmenForm::where('id', $offerId)->first();
                            if ($entry['canceled'] == 0) {
                                $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                                $update = FirmenForm::where('id', $offerId)->update([
                                    'canceled' => 1,
                                ]);
            
                                if($entry['status'] == 'Aktif') {
                                    $update5 = FirmenForm::where('id', $offerId)->update([
                                        'status' => 'Pasif',
                                    ]);
                                    $update2 = OfferFirma::where('offerId', $offerId)->update([
                                        'status' => 'Pasif'
                                    ]);
                                }
            
                                foreach ($getOFirmas as $getOFirma) {
                                    $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                                    $form = FirmenForm::where('id',$offerId)->first();
                                    if($firmas['mail'])
                                    {
                                        $emailData = [
                                            'sub' => $form['entryId'].' '.'Numaralı Teklif İptal Edildi',
                                            'from' => 'info@umzugspreisvergleich.ch',
                                            'companyName' => 'Umzugspreisvergleich.ch',
                                            'offer' => $form,
                                            'type' => $type,
                                            'canceled' => $form['canceled']
                                        ];
                                        Mail::to($firmas['mail'])->send(new OfferStatusNotify($emailData));
                                    }
                                    if($entry['status'] == 'Aktif') {
                                        $update3 = Firma::where('id', $firmas->id)->update([
                                            'counter1' => $firmas->counter1 - 1
                                        ]);
                                    }
                                    $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                                    if ($firmas2->counter1 < $firmas2->counter2) {
                                        $update4 = Firma::where('id', $firmas2->id)->update([
                                            'status' => 'Aktif'
                                        ]);
                                    } else {
                                        $update4 = Firma::where('id', $firmas2->id)->update([
                                            'status' => 'Pasif'
                                        ]);
                                    }
                                }
                                
                                
                                
                            } else {
                                $getOFirmas = OfferFirma::where('offerId', $offerId)->get();
                                $update = FirmenForm::where('id', $offerId)->update([
                                    'canceled' => 0,
                                ]);
                                foreach ($getOFirmas as $getOFirma) {
                                    $firmas = Firma::where('id', $getOFirma->firmaId)->first();
                                    $form = FirmenForm::where('id',$offerId)->first();
                                    
                                    if($entry['status'] == 'Pasif') {
                                        $update5 = FirmenForm::where('id', $offerId)->update([
                                            'status' => 'Aktif',
                                        ]);
                                        $update2 = OfferFirma::where('offerId', $offerId)->update([
                                            'status' => 'Aktif'
                                        ]);
                                    }
                                    if($firmas['mail'])
                                    {
                                        $emailData = [
                                            'sub' => $form['entryId'].' '.'Numaralı Teklif Onaylandı',
                                            'from' => 'info@umzugspreisvergleich.ch',
                                            'companyName' => 'Umzugspreisvergleich.ch',
                                            'offer' => $form,
                                            'type' => $type,
                                            'canceled' => $form['canceled']
                                        ];
                                        Mail::to($firmas['mail'])->send(new OfferStatusNotify($emailData));
                                    }
                                    if($entry['status'] == 'Pasif') {
                                        $update3 = Firma::where('id', $firmas->id)->update([
                                            'counter1' => $firmas->counter1 + 1
                                        ]);
                                    }
                                    $firmas2 = Firma::where('id', $getOFirma->firmaId)->first();
                                    if ($firmas2->counter1 < $firmas2->counter2) {
                                        $update4 = Firma::where('id', $firmas2->id)->update([
                                            'status' => 'Aktif'
                                        ]);
                                    } else {
                                        $update4 = Firma::where('id', $firmas2->id)->update([
                                            'status' => 'Pasif'
                                        ]);
                                    }
                                }
                            }
                            break;
        }
        

        if($update) {
            return redirect()
                ->route('offerList.index')
                ->with('status', $form['entryId'] . ' - ' . 'Numaralı Teklif Güncellendi')
                ->with('keep_status', true);
        } else {
            return redirect()->back()->with('status', 'Fehler: Teklif Güncellenemedi');
        }
    }
}
