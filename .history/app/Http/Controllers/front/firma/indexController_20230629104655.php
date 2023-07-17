<?php

namespace App\Http\Controllers\front\firma;

use App\Http\Controllers\Controller;
use App\Models\Firma;
use App\Models\FirmenForm;
use App\Models\KontaktForm;
use App\Models\OfferFirma;
use App\Models\PrivatUmzugForm;
use App\Models\ReinigungForm;
use App\Models\schnellenform;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Carbon\Carbon;



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
            'counter1' => $request->entryRecord,
            'counter2' => $request->entryLimit,
            'status' => $request->firmaStatus,
        ];

        $create = Firma::create($firma);

        if($create)
        {   
            return redirect()->back()->with('status','Firma Başarıyla Eklendi');
        }
        else {
            return redirect()->back()->with('status2','Hata:Firma Eklenemedi');
        }
    }

    public function edit($id)
    {
        $c = Firma::where('id',$id)->count();
        if($c !=0)
        {
            $data = Firma::where('id',$id)->first();
            return view ('front.firma.edit', ['data' => $data]);
        }
    }

    public function detail($id)
    {
        $c = Firma::where('id',$id)->count();
        
        if($c !=0)
        {
            $data = Firma::where('id',$id)->first();
            
            return view ('front.firma.detail', ['data' => $data]);
        }
        
    }

    public function delete($id)
    {
        $c = Firma::where('id',$id)->count();
        if($c !=0)
        {
            $records = OfferFirma::where('firmaId',$id)->delete();
            $delete = Firma::where('id',$id)->delete();

            if($delete) 
            {   
                return redirect()->back()->with('status','Firma Başarıyla Silindi');
            }
            else {
                return redirect()->back()->with('status2','Hata:Firma Silinemedi');
            }
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Firma::where('id',$id)->count();
        if($c !=0)
        {
            $all = $request->except('_token');
            $data = Firma::where('id',$id)->first();
            
            $update = Firma::where('id',$id)->update($firma = [
                'name' => $request->firmaName,
                'mail' => $request->firmaMail,
                'counter1' => $request->entryRecord,
                'counter2' => $request->entryLimit,
                'status' => $request->firmaStatus,
            ]);

        }
        if($update) 
            {   
                return redirect()->back()->with('status','Firma Başarıyla Güncellendi');
            }
            else {
                return redirect()->back()->with('status2','Hata:Firma Güncellenemedi');
            }
    }

    public function data()
    {
        $table=Firma::query();
        $data=DataTables::of($table)
        

        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-detail" href="'.route('firma.detail',['id'=>$table->id]).'"><i class="feather feather-eye" ></i></a> 
            <a class="btn btn-sm  btn-primary" href="'.route('firma.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> 
            <a class="btn btn-sm  btn-danger"  href="'.route('firma.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['option'])
        ->make(true);

        return $data;
    }

    public function recordData( Request $request)
    {
        $id = $request->route('id');
        $table=OfferFirma::query()->where('firmaId',$id);
        
        // Minimum date filter
        if($request->min_date) {
            $table->whereDate('created_at', '>=', $request->min_date);
        }
        
        // Maximum date filter
        if($request->max_date) {
            $table->whereDate('created_at', '<=', $request->max_date);
        }
        
        $data=DataTables::of($table)
        
        ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
            return $formatedDate;
        })
        ->editColumn('firmaId', function ($data){
            $firma = Firma::where('id',$data['firmaId'])->first();
            return $firma['name'];
        })
        ->addColumn('customer', function ($data){
            if($data['type'] == 'Schnellanfrage') {
                $customer = schnellenform::where('id',$data['offerId'])->first();
            }
            elseif($data['type'] == 'Reinigung')
            {
                $customer = ReinigungForm::where('id',$data['offerId'])->first();
            }
            elseif($data['type'] == 'PrivatUmzug')
            {
                $customer = PrivatUmzugForm::where('id',$data['offerId'])->first();
            }
            elseif($data['type'] == 'Firmen')
            {
                $customer = FirmenForm::where('id',$data['offerId'])->first();
            }
            elseif($data['type'] == 'Kontakt')
            {
                $customer = KontaktForm::where('id',$data['offerId'])->first();
            }
            
            return $customer['fullname'];
        })
        ->editColumn('status', function ($data) {
            if($data['status'] == 'Pasif')
            {
                return '<a class="btn btn-sm  btn-warning px-5">Pasif</a>';
            }
            else {
                return '<a class="btn btn-sm  btn-success px-5">Aktif</a>';
            }
        })

        ->addColumn('option',function($array) 
        {
            return '<a class="btn  btn-detail" href="' . route('offerList.detail', ['id' => $array['offerId'], 'type' => $array['type']]) . '">Detail</a>';
        })
        ->rawColumns(['option','customer','status'])
        ->make(true);
        $renderedData = (array)$data->original;
        $renderedData['aktifTotal'] = $table->where('status','Pasif')->count();
        
        return response()->json($renderedData);
    }
    
}
