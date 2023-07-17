@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Firma Düzenle</h1>
            </div>
        </div>
    </div>

   <div class="container">
    @if (session("status"))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-success">
                {{ session("status") }}
            </div>
        </div>
    </div>
    @endif

    @if (session("status2"))
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    {{ session("status2") }}
                </div>
            </div>
        </div>
    @endif
   </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('firma.update',['id'=>$data['id']]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row firma--area" >
                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Firmenname</label>
                            <input class="form-control" name="firmaName"  type="text" value="{{ $data['name'] }}" required>                                
                        </div>
    
                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Email</label>
                            <input class="form-control"  name="firmaMail"  type="text" value="{{ $data['mail'] }}" required>                                 
                        </div>

                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Offers</label>
                            <input class="form-control"  name="entryLimit"  type="number" value="{{ $data['counter1'] }}" required>                                 
                        </div>

                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Offer Limit</label>
                            <input class="form-control"  name="entryLimit"  type="number" value="{{ $data['counter2'] }}" required>                                 
                        </div>
                    </div>
                    <div class="form-actions mt-3">
                        <div class="form-group row">
                            <div class="col-md-12 ml-md-auto btn-list">
                                <button class="btn btn-primary btn-rounded" type="submit">Erstellen</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection