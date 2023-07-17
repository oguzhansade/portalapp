<?php

namespace App\Http\Controllers\front\firma;

use App\Http\Controllers\Controller;
use App\Models\Firma;
use App\Models\OfferFirma;
use Yajra\DataTables\Facades\DataTables;
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
                'counter2' => $request->entryRecord,
                'counter2' => $request->entryLimit,
                'status' => $request->firmaStatus,
            ]);

        }
    }

    public function data()
    {
        $table=Firma::query();
        $data=DataTables::of($table)
        
        // ->editColumn('productName', function($table){
        //     return '<a class="clickableCell" href="'.route('product.edit',['id'=>$table->id]).'">'.$table->productName.'</a>';
        // }, 'td')

        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-detail" href="'.route('firma.detail',['id'=>$table->id]).'"><i class="feather feather-eye" ></i></a> 
            <a class="btn btn-sm  btn-primary" href="'.route('firma.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> 
            <a class="btn btn-sm  btn-danger"  href="'.route('firma.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['option','productName'])
        ->make(true);

        return $data;
    }

    public function recordData()
    {
        $table=OfferFirma::query();
        $data=DataTables::of($table)
        
        // ->editColumn('productName', function($table){
        //     return '<a class="clickableCell" href="'.route('product.edit',['id'=>$table->id]).'">'.$table->productName.'</a>';
        // }, 'td')

        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-detail" href="'.route('firma.detail',['id'=>$table->id]).'"><i class="feather feather-eye" ></i></a> 
            <a class="btn btn-sm  btn-primary" href="'.route('firma.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> 
            <a class="btn btn-sm  btn-danger"  href="'.route('firma.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['option','productName'])
        ->make(true);

        return $data;
    }
    
}
