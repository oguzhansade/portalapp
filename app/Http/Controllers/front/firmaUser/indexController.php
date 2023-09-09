<?php

namespace App\Http\Controllers\front\firmaUser;

use App\Http\Controllers\Controller;
use App\Models\Firma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class indexController extends Controller
{
    public function edit($id)
    {
        $c = Firma::where('id',$id)->count();
        if($c !=0)
        {
            $data = Firma::where('id',$id)->first();
            return view ('front.firmaUser.edit', ['data' => $data]);
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
                return redirect()->back()->with('status','Firmanız Başarıyla Güncellendi');
            }
            else {
                return redirect()->back()->with('status2','Hata:Firmanız Güncellenemedi');
            }
    }
}
