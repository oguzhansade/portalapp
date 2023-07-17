@extends('layouts.app')
@section('header')
<style>
    .hvr-grow {
        display: inline-block;
        vertical-align: middle;
        transform: translateZ(0);
        box-shadow: 0 0 1px rgba(0, 0, 0, 0);
        backface-visibility: hidden;
        -moz-osx-font-smoothing: grayscale;
        transition-duration: 0.3s;
        transition-property: transform;
        }
    
        .hvr-grow:hover,
        .hvr-grow:focus,
        .hvr-grow:active {
            transform: scale(1.1);
        }
    
        .bg-offer {
            background-color: #c7a5f1;
        }
        .b-shadow {
            box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        }
        .custom-font {
            color: white;
            font-weight: 700;
        }
        .rounded-custom {
            border-radius: 35px;
        }
        .notify-badge{
        position: absolute;
        right:-10px;
        top:-10px;
        background:#e65454;
        text-align: center;
        border-radius: 55px;
        color:white;
        padding:5px 15px;
        font-size:20px;
        }
    </style>
@endsection
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
    <div class="container">
        <div class="row d-flex p-0 justify-content-start" >
            <div class="col-md-12 d-flex justify-content-start">
                <span class="h4 px-4 py-2 bg-primary text-white b-shadow rounded-custom">Welcome: <b>{{ App\Models\User::getUser(Auth::id(),'name') }}</b></span> </span>
            </div>
        </div>
        
        <div class="row d-flex justify-content-start mt-3">
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