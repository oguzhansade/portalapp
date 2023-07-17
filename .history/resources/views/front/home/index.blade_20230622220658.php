@extends('layouts.app')
@section('content')
    {{-- <div class="container">
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
    </div> --}}

    <div class="container-fluid">
        <div class="row d-flex justify-content-start">
            <div class="col-lg-3 col-md-6 col-sm-6 p-1">
                <a href="" class="hvr-grow">
                    <div class="card b-shadow" style="width: 18rem;border:0;border-radius:35px;">
                        <span class="notify-badge"></span>
                        <img src="{{ asset('assets/demo/workerPanel-task-button.svg') }}" class="card-img-top p-3" alt="..." height="150">
                        <div class="card-body bg-primary b-shadow" style="border-bottom-left-radius:35px;border-bottom-right-radius:35px;">
                          <h5 class="card-title text-white text-center">Aufgaben </h5>
                          <p class="card-text"></p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 p-1">
                <a href="" class="hvr-grow ">
                    <div class="card b-shadow" style="width: 18rem;border:0;border-radius:35px;">
                        <img src="{{ asset('assets/demo/workerPanel-profile-button1.svg') }}" class="card-img-top p-3 " alt="..." height="150">
                        <div class="card-body bg-primary b-shadow" style="border-bottom-left-radius:35px;border-bottom-right-radius:35px;">
                          <h5 class="card-title text-white text-center">Profil </h5>
                          <p class="card-text"></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection