@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <h1>Hoşgeldiniz</h1>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-center">
                <h3>Toplam Gönderilen Teklif</h3><br>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <strong style="color:#8253eb;" class="h1">{{ \App\Models\OfferFirma::getOfferTotal() }}</strong>
            </div>
        </div>
    </div>
@endsection