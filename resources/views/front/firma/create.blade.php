@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Firma Erstellen</h1>
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
                <form action="{{ route('firma.store') }}" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
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
                            <label class=" col-form-label" for="l0">Password</label>
                            <input class="form-control"  name="firmaPassword"  type="password" required>                                 
                        </div>

                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Telefon</label>
                            <input class="form-control"  name="firmaTelefon"  type="text" required>                                 
                        </div>

                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Address</label>
                            <input class="form-control"  name="firmaAddress"  type="text" required>                                 
                        </div>

                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Contact Person</label>
                            <input class="form-control"  name="firmaContactPerson"  type="text" required>                                 
                        </div>

                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Website</label>
                            <input class="form-control"  name="firmaWebsite"  type="text" >                                 
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
                        <div class="mt-3">
                            <label for="" class="col-form-label">Kantons</label><br>
                            <div id="checkbox-container">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Aargau" name="kantoArray[]" value="Aargau" checked>
                                    <label class="form-check-label" for="Aargau">Aargau</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="AppenzellAusserrhoden" name="kantoArray[]" value="Appenzell Ausserrhoden">
                                    <label class="form-check-label" for="AppenzellAusserrhoden">Appenzell Ausserrhoden</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="AppenzellInnerrhoden" name="kantoArray[]" value="Appenzell Innerrhoden"  >
                                    <label class="form-check-label" for="AppenzellInnerrhoden">Appenzell Innerrhoden</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Basel-Landschaft" name="kantoArray[]" value="Basel-Landschaft"  >
                                    <label class="form-check-label" for="Basel-Landschaft">Basel-Landschaft</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Basel-Stadt" name="kantoArray[]" value="Basel-Stadt"  >
                                    <label class="form-check-label" for="Basel-Stadt">Basel-Stadt</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Bern" name="kantoArray[]" value="Bern">
                                    <label class="form-check-label" for="Bern">Bern</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Fribourg" name="kantoArray[]" value="Fribourg">
                                    <label class="form-check-label" for="Fribourg">Fribourg</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Genève" name="kantoArray[]" value="Genève"  >
                                    <label class="form-check-label" for="Genève">Genève</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Glarus" name="kantoArray[]" value="Glarus"  >
                                    <label class="form-check-label" for="Glarus">Glarus</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Graubünden" name="kantoArray[]" value="Graubünden"  >
                                    <label class="form-check-label" for="Graubünden">Graubünden</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Jura" name="kantoArray[]" value="Jura">
                                    <label class="form-check-label" for="Jura">Jura</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Luzern" name="kantoArray[]" value="Luzern">
                                    <label class="form-check-label" for="Luzern">Luzern</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Neuchâtel" name="kantoArray[]" value="Neuchâtel"  >
                                    <label class="form-check-label" for="Neuchâtel">Neuchâtel</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Nidwalden" name="kantoArray[]" value="Nidwalden"  >
                                    <label class="form-check-label" for="Nidwalden">Nidwalden</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Obwalden" name="kantoArray[]" value="Obwalden"  >
                                    <label class="form-check-label" for="Obwalden">Obwalden</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Schaffhausen" name="kantoArray[]" value="Schaffhausen">
                                    <label class="form-check-label" for="Schaffhausen">Schaffhausen</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Schwyz" name="kantoArray[]" value="Schwyz">
                                    <label class="form-check-label" for="Schwyz">Schwyz</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Solothurn" name="kantoArray[]" value="Solothurn"  >
                                    <label class="form-check-label" for="Solothurn">Solothurn</label>
                                </div>
                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="StGallen" name="kantoArray[]" value="St. Gallen">
                                    <label class="form-check-label" for="StGallen">St. Gallen</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Thurgau" name="kantoArray[]" value="Thurgau"  >
                                    <label class="form-check-label" for="Thurgau">Thurgau</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Ticino" name="kantoArray[]" value="Ticino"  >
                                    <label class="form-check-label" for="Ticino">Ticino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Uri" name="kantoArray[]" value="Uri"  >
                                    <label class="form-check-label" for="Uri">Uri</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Valais" name="kantoArray[]" value="Valais"  >
                                    <label class="form-check-label" for="Valais">Valais</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Vaud" name="kantoArray[]" value="Vaud"  >
                                    <label class="form-check-label" for="Vaud">Vaud</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"   type="checkbox" id="Zug" name="kantoArray[]" value="Zug"  checked>
                                    <label class="form-check-label" for="Zug">Zug</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Zürich" name="kantoArray[]" value="Zürich" checked>
                                    <label class="form-check-label" for="Zürich">Zürich</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Ausland" name="kantoArray[]" value="Ausland" >
                                    <label class="form-check-label" for="Ausland">Ausland</label>
                                </div><br>
                                
                                
                            </div>
                        </div>
                    <div class="form-actions mt-3">
                        <div class="form-group row">
                            <div class="col-md-12 ml-md-auto btn-list">
                                <button class="btn btn-primary btn-rounded" type="submit" >Erstellen</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
<script>
    function validateForm() {
    // Get all the checkboxes
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    let checkedCount = 0;

    // Count the number of checked checkboxes
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            checkedCount++;
        }
    });

    // Check if at least one checkbox is checked
    if (checkedCount === 0) {
        alert("Please select at least one checkbox.");
        return false; // Prevent form submission
    }

        // Form is valid, allow submission
        // You can remove the line below if you're using this code within a <form> element
        return true;
    }
</script>
@endsection
