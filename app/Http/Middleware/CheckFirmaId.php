<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckFirmaId
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
        // Eğer firmaId değeri 0'dan büyükse ve route'dan gelen id ile eşitse, izin verelim
        if ($firmaId > 0 && $firmaId == $request->route('id') && $request->routeIs('firma.detail') || $request->routeIs('firma.recordData')) {
            return $next($request);
        }

        if($firmaId == 0)
        {
            return $next($request);
        }
        // Diğer durumda 403 hatası verelim
        return abort(403, 'Bu sayfaya erişim izniniz bulunmamaktadır.');
    }

    // Eğer kullanıcı giriş yapmamışsa, diğer rotalara izin veriyoruz
    return $next($request);
    }
}
