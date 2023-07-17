@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Firma Oluştur</h1>
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
                <form action="{{ route('firma.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row firma--area" >
                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Firmenname</label>
                            <input class="form-control" name="firmaName"  type="text" required>                                
                        </div>
    
                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Email</label>
                            <input class="form-control"  name="firmaMail"  type="text" required>                                 
                        </div>

                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Offers</label>
                            <input class="form-control"  name="entryRecord"  type="number" value="0" required>                                 
                        </div>

                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Offer Limit</label>
                            <input class="form-control"  name="entryLimit"  type="number" value="100" required>                                 
                        </div>

                        <div class="col-md-3">
                            <label for="" class="col-form-label">Status</label><br>
                            <select class="form-control" name="firmaStatus" id="firmaStatus">
                                <option value="Aktif" selected>Active</option>
                                <option value="Pasif">Passive</option>
                            </select>
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