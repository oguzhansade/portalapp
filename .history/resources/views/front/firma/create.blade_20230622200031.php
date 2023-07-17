@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Firma Oluştur</h1>
            </div>
        </div>
    </div>

    @if (session("status"))
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{ session("status") }}
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="">
                    <div class="form-group row firma--area" >
                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Firmenname</label>
                            <input class="form-control" name="firmaName"  type="text">                                
                        </div>
    
                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Email</label>
                            <input class="form-control"  name="firmaMail"  type="text">                                
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection