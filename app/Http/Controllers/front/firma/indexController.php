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
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;





class indexController extends Controller
{
    public function change()
    {
        
    }
    public function mailTest()
    {
        $data = schnellenform::where('id',247)->first();
        $offer = [
            'offer' => $data,
        ];
        return view('front.firma.mailTester', ['data' => $offer]);
    }
    public function index()
    {
        $veriler = schnellenform::all(); // Tüm verileri çek

        foreach ($veriler as $veri) {
            $zimmer = $veri->zimmer; // privatUmzug da farklı
            $zimmerU = $zimmer;
            // "1/2" ifadesini "0.5" ile değiştir
            if($zimmer == '1 1/2 Zimmer / Räume')
            {
                $zimmerU = '1.5 Zimmer / Räume';
            }
            if($zimmer == '1 1/2 Zimmer / Raum')
            {
                $zimmerU = '1.5 Zimmer / Räume';
            }
            elseif($zimmer == '2 1/2 Zimmer / Räume')
            {
                $zimmerU = '2.5 Zimmer / Räume';
            }
            elseif($zimmer == '3 1/2 Zimmer / Räume')
            {
                $zimmerU = '3.5 Zimmer / Räume';
            }
            elseif($zimmer == '4 1/2 Zimmer / Räume')
            {
                $zimmerU = '4.5 Zimmer / Räume';
            }
            elseif($zimmer == '5 1/2 Zimmer / Räume')
            {
                $zimmerU = '5.5 Zimmer / Räume';
            }
            elseif($zimmer == '6 1/2 Zimmer / Räume')
            {
                $zimmerU = '6.5 Zimmer / Räume';
            }
            elseif($zimmer == '1.5 Zimmer')
            {
                $zimmerU = '1.5 Zimmer / Räume';
            }
            elseif($zimmer == '1 Zimmer')
            {
                $zimmerU = '1 Zimmer / Raum';
            }
            elseif($zimmer == '2 Zimmer')
            {
                $zimmerU = '2 Zimmer Räume';
            }
            elseif($zimmer == '2.5 Zimmer')
            {
                $zimmerU = '2.5 Zimmer / Räume';
            }
            elseif($zimmer == '3 Zimmer')
            {
                $zimmerU = '3 Zimmer / Räume';
            }
            elseif($zimmer == '3.5 Zimmer')
            {
                $zimmerU = '3.5 Zimmer / Räume';
            }
            elseif($zimmer == '4 Zimmer')
            {
                $zimmerU = '4 Zimmer / Räume';
            }
            elseif($zimmer == '4.5 Zimmer')
            {
                $zimmerU = '4.5 Zimmer / Räume';
            }
            elseif($zimmer == '5 Zimmer')
            {
                $zimmerU = '5 Zimmer / Räume';
            }
            elseif($zimmer == '5.5 Zimmer')
            {
                $zimmerU = '5.5 Zimmer / Räume';
            }
            elseif($zimmer == '6 Zimmer')
            {
                $zimmerU = '6 Zimmer / Räume';
            }
            elseif($zimmer == '6.5 Zimmer')
            {
                $zimmerU = '6.5 Zimmer / Räume';
            }
            
            // Düzenlenmiş değeri güncelle
            $veri->zimmer = $zimmerU;
            $veri->save();
        }

        return view('front.firma.index');
    }
    public function create()
    {
        return view('front.firma.create');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token');

        $kantoArray = $request->input('kantoArray');
        $kantons = implode(',', $kantoArray); // Diziyi virgülle ayrılmış bir dizeye dönüştürür
        $firma = [
            'name' => $request->firmaName,
            'mail' => $request->firmaMail,
            'counter1' => $request->entryRecord,
            'counter2' => $request->entryLimit,
            'status' => $request->firmaStatus,
            'kantons' => $kantons,
            'address' => $request->firmaAddress,
            'telefon' => $request->firmaTelefon,
            'contactPerson' => $request->firmaContactPerson,
            'website' => $request->firmaWebsite
        ];

        $create = Firma::create($firma);
        $idFinder = DB::table('firmas')->orderBy('id', 'DESC')->first(); // Son Eklenen firmanın id'si
        $firmaId = $idFinder->id;

        $userCreate = [
            'name' => $request->firmaName,
            'email' => $request->firmaMail,
            'firmaId' => $firmaId,
            'password' => Hash::make($request->firmaPassword),
        ];
        $createUser = User::create($userCreate);
        if($create && $createUser)
        {   
            return redirect()->back()->with('status','Firma Başarıyla Eklendi Kullanıcı Oluşturuldu');
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
            $deleteUser = User::where('firmaId',$id)->delete();
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
            
            $kantoArray = $request->input('kantoArray');
            $kantons = implode(',', $kantoArray); // Diziyi virgülle ayrılmış bir dizeye dönüştürür
        
            $updateFirma = [
                'name' => $request->firmaName,
                'mail' => $request->firmaMail,
                'counter1' => $request->entryRecord,
                'counter2' => $request->entryLimit,
                'status' => $request->firmaStatus,
                'kantons' => $kantons,
                'address' => $request->firmaAddress,
                'telefon' => $request->firmaTelefon,
                'contactPerson' => $request->firmaContactPerson,
                'website' => $request->firmaWebsite
            ];
            
            $password = $request->firmaPassword;
            if($password == "") {
                $user = [
                    'name' => $request->firmaName,
                    'email' => $request->firmaMail,
                    
                ];
                
            }
            else{
                $user = [
                    'name' => $request->firmaName,
                    'email' => $request->firmaMail,
                    'password' => Hash::make($password),
                ];
            }
            
            $update = Firma::where('id',$id)->update($updateFirma);
            $updateUser = User::where('firmaId',$id)->update($user);
            
        }
        if($update && $updateUser) 
            {   
                return redirect()->back()->with('status','Firma Başarıyla Güncellendi');
            }
            else {
                return redirect()->back()->with('status2','Hata:Firma Güncellenemedi');
            }
    }

    public function data(Request $request)
    {
        $table=Firma::query();

        if($request->status) {
            if($request->status == 'Aktif')
            {
                $table->where('status', 'Aktif');
            }
            else if($request->status == 'Pasif')
            {
                $table->where('status', 'Pasif');
            }
            else if ($request->status == 'Alle'){

            }
        }

        $data=DataTables::of($table)
        

        ->editColumn('status', function($table){
            if($table->status == 'Pasif')
            {
                return '<button class="btn btn-sm btn-warning">Pasif</button>';
            }
            else {
                return '<button class="btn btn-sm btn-success">Aktif</button>';
            }
        })
        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-detail" href="'.route('firma.detail',['id'=>$table->id]).'"><i class="feather feather-eye" ></i></a> 
            <a class="btn btn-sm  btn-primary" href="'.route('firma.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> 
            <a class="btn btn-sm  btn-danger"  href="'.route('firma.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['option','status'])
        ->make(true);

        return $data;
    }

    public function recordData( Request $request)
    {
        $id = $request->route('id');
        $table = OfferFirma::query()->where('firmaId', $id);
        $offers = OfferFirma::query()->where('firmaId', $id)->pluck('offerId')->toArray();
                
       

        $toplamTeklif = $table->count();

        // Minimum date filter
        if ($request->min_date) {
            $table->whereDate('created_at', '>=', $request->min_date);
        }

        // Maximum date filter
        if ($request->max_date) {
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
        $renderedData['pasifTotal'] = (clone $table)->where('status', 'Pasif')->count(); // Eloquent modelde yukarıdan aşşağı filter aşşağıya aktarılır (clone $4rt)
        $renderedData['aktifTotal'] = $table->where('status', 'Aktif')->count();
        $renderedData['netTotal'] = $renderedData['aktifTotal'] - $renderedData['pasifTotal'];
        $renderedData['toplamTeklif'] = $toplamTeklif;
        return response()->json($renderedData);
    }
    
}
