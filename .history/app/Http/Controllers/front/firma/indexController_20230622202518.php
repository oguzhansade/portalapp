<?php

namespace App\Http\Controllers\front\firma;

use App\Http\Controllers\Controller;
use App\Models\Firma;
use yajra\DataTables\Facades\DataTables;
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

        $create = Firma::create($firma);

        if($create)
        {   
            return redirect()->back()->with('status','Firma Başarıyla Eklendi');
        }
        else {
            return redirect()->back()->with('status2','Hata:Müşteri Eklenemedi');
        }
    }

    public function edit($id)
    {
        $c = Firma::where('id',$id)->count();
        if($c !=0)
        {
            $data = Firma::where('id',$id)->get();
            return view ('front.firma.edit', ['data' => $data]);
        }
    }

    public function data()
    {
        $table=Firma::query();
        $data=DataTables::of($table)
        
        ->editColumn('productName', function($table){
            return '<a class="clickableCell" href="'.route('product.edit',['id'=>$table->id]).'">'.$table->productName.'</a>';
        }, 'td')

        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-edit" href="'.route('product.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-danger"  href="'.route('product.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['option','productName'])
        ->make(true);

        return $data;
    }
    
}
