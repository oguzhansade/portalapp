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

    <div class="row">
        <div class="col-md-12">
            <form action="">
                <div class="form-group row firma--area" style="display: none;">
                    <div class="col-md-6">
                        <label class=" col-form-label" for="l0">Firmenname</label>
                        <input class="form-control" name="companyName"  type="text">                                
                    </div>

                    <div class="col-md-6">
                        <label class=" col-form-label" for="l0">Kontaktperson</label>
                        <input class="form-control"  name="contactPerson"  type="text">                                
                    </div>
            </div>
            </form>
        </div>
    </div>
@endsection