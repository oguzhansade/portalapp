<?php

namespace App\Http\Middleware;

use App\Models\OfferFirma;
use App\Models\OfferList;
use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckOfferId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Kullanıcı giriş yapmış mı kontrol edelim
        if (Auth::check()) {
            // Kullanıcının firmaId değerini alalım
            $firmaId = User::getUser(Auth::id(), 'firmaId');
            $offers = OfferFirma::where('firmaId', $firmaId)->get(); // 2 adet veri geldi
        
            // Eğer firmaId değeri 0'dan büyükse ve route'dan gelen id ile eşitse, izin verelim
            if ($firmaId > 0 && $request->routeIs('offerList.detail')) {
                $requestedOfferId = $request->route('id');
        
                // İstenen id $offers dizisinde varsa, o id'ye karşılık gelen type değerini alalım
                $matchingOffer = $offers->firstWhere('offerId', $requestedOfferId);
        
                if ($matchingOffer !== null) {
                    $requestedType = $matchingOffer->type;
        
                    if($requestedType ==$request->route('type')){
                    return $next($request);
                    }
                    // Diğer işlemleri yapabilirsiniz ve izin vermek için return $next($request) kullanabilirsiniz
                    // return $next($request);
                }
            }
        
            if ($firmaId == 0) {
                return $next($request);
            }
        
            // Diğer durumda 403 hatası verelim
            return abort(403, 'Bu sayfaya erişim izniniz bulunmamaktadır.');
        }
        
     }
}
