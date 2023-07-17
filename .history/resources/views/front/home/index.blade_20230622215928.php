@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Anasayfa</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Toplam Gönderilen Teklif</h3>
                <strong>{{ \App\Models\OfferFirma::getOfferTotal() }}</strong>
            </div>
        </div>
    </div>
@endsection