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
                <form action="{{ route('firma.update',['id'=>$data['id']]) }}" onsubmit="return validateForm()" method="POST" enctype="multipart/form-data">
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
                            <input class="form-control"  name="entryRecord"  type="number" value="{{ $data['counter1'] }}" required>                                 
                        </div>

                        <div class="col-md-6">
                            <label class=" col-form-label" for="l0">Offer Limit</label>
                            <input class="form-control"  name="entryLimit"  type="number" value="{{ $data['counter2'] }}" required>                                 
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Status</label><br>
                            <select class="form-control" name="firmaStatus" id="firmaStatus">
                                <option value="Aktif" @if($data['status'] == 'Aktif') selected @endif>Active</option>
                                <option value="Pasif" @if($data['status'] == 'Pasif') selected @endif>Passive</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="" class="col-form-label">Kantons</label><br>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Aargau" name="kantoArray[]" value="Aargau" >
                                    <label class="form-check-label" for="Aargau"
                                    @if (in_array('Aargau', explode(',', $data['kantons']))) checked @endif>Aargau</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="AppenzellAusserrhoden" name="kantoArray[]" value="Appenzell Ausserrhoden"
                                    @if (strpos($data['kantons'], 'Appenzell Ausserrhoden') !== false) checked @endif>
                                    <label class="form-check-label" for="AppenzellAusserrhoden">Appenzell Ausserrhoden</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="AppenzellInnerrhoden" name="kantoArray[]" value="Appenzell Innerrhoden"  
                                    @if (strpos($data['kantons'], 'Appenzell Innerrhoden') !== false) checked @endif>
                                    <label class="form-check-label" for="AppenzellInnerrhoden">Appenzell Innerrhoden</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Basel-Landschaft" name="kantoArray[]" value="Basel-Landschaft"  
                                    @if (strpos($data['kantons'], 'Basel-Landschaft') !== false) checked @endif>
                                    <label class="form-check-label" for="Basel-Landschaft">Basel-Landschaft</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Basel-Stadt" name="kantoArray[]" value="Basel-Stadt"  
                                    @if (strpos($data['kantons'], 'Basel-Stadt') !== false) checked @endif>
                                    <label class="form-check-label" for="Basel-Stadt">Basel-Stadt</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Bern" name="kantoArray[]" value="Bern"
                                    @if (strpos($data['kantons'], 'Bern') !== false) checked @endif>
                                    <label class="form-check-label" for="Bern">Bern</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Fribourg" name="kantoArray[]" value="Fribourg"
                                    @if (strpos($data['kantons'], 'Fribourg') !== false) checked @endif>
                                    <label class="form-check-label" for="Fribourg">Fribourg</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Genève" name="kantoArray[]" value="Genève"  
                                    @if (strpos($data['kantons'], 'Genève') !== false) checked @endif>
                                    <label class="form-check-label" for="Genève">Genève</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Glarus" name="kantoArray[]" value="Glarus"  
                                    @if (strpos($data['kantons'], 'Glarus') !== false) checked @endif>
                                    <label class="form-check-label" for="Glarus">Glarus</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Graubünden" name="kantoArray[]" value="Graubünden"  
                                    @if (strpos($data['kantons'], 'Graubünden') !== false) checked @endif>
                                    <label class="form-check-label" for="Graubünden">Graubünden</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Jura" name="kantoArray[]" value="Jura"
                                    @if (strpos($data['kantons'], 'Jura') !== false) checked @endif>
                                    <label class="form-check-label" for="Jura">Jura</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Luzern" name="kantoArray[]" value="Luzern"
                                    @if (strpos($data['kantons'], 'Luzern') !== false) checked @endif>
                                    <label class="form-check-label" for="Luzern">Luzern</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Neuchâtel" name="kantoArray[]" value="Neuchâtel"  
                                    @if (strpos($data['kantons'], 'Neuchâtel') !== false) checked @endif>
                                    <label class="form-check-label" for="Neuchâtel">Neuchâtel</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Nidwalden" name="kantoArray[]" value="Nidwalden"  
                                    @if (strpos($data['kantons'], 'Nidwalden') !== false) checked @endif>
                                    <label class="form-check-label" for="Nidwalden">Nidwalden</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Obwalden" name="kantoArray[]" value="Obwalden"  
                                    @if (strpos($data['kantons'], 'Obwalden') !== false) checked @endif>
                                    <label class="form-check-label" for="Obwalden">Obwalden</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Schaffhausen" name="kantoArray[]" value="Schaffhausen"
                                    @if (strpos($data['kantons'], 'Schaffhausen') !== false) checked @endif>
                                    <label class="form-check-label" for="Schaffhausen">Schaffhausen</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Schwyz" name="kantoArray[]" value="Schwyz"
                                    @if (strpos($data['kantons'], 'Schwyz') !== false) checked @endif>
                                    <label class="form-check-label" for="Schwyz">Schwyz</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Solothurn" name="kantoArray[]" value="Solothurn" 
                                    @if (strpos($data['kantons'], 'Solothurn') !== false) checked @endif>
                                    <label class="form-check-label" for="Solothurn">Solothurn</label>
                                </div>
                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="StGallen" name="kantoArray[]" value="St. Gallen"
                                    @if (strpos($data['kantons'], 'St. Gallen') !== false) checked @endif>
                                    <label class="form-check-label" for="StGallen">St. Gallen</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Thurgau" name="kantoArray[]" value="Thurgau"
                                    @if (strpos($data['kantons'], 'Thurgau') !== false) checked @endif>
                                    <label class="form-check-label" for="Thurgau">Thurgau</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Ticino" name="kantoArray[]" value="Ticino" 
                                    @if (strpos($data['kantons'], 'Ticino') !== false) checked @endif >
                                    <label class="form-check-label" for="Ticino">Ticino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Uri" name="kantoArray[]" value="Uri"  
                                    @if (strpos($data['kantons'], 'Uri') !== false) checked @endif>
                                    <label class="form-check-label" for="Uri">Uri</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Valais" name="kantoArray[]" value="Valais"  
                                    @if (strpos($data['kantons'], 'Valais') !== false) checked @endif>
                                    <label class="form-check-label" for="Valais">Valais</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Vaud" name="kantoArray[]" value="Vaud"  
                                    @if (strpos($data['kantons'], 'Vaud') !== false) checked @endif>
                                    <label class="form-check-label" for="Vaud">Vaud</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"   type="checkbox" id="Zug" name="kantoArray[]" value="Zug"  >
                                    <label class="form-check-label" for="Zug"
                                    @if (strpos($data['kantons'], 'Zug') !== false) checked @endif>Zug</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  type="checkbox" id="Zürich" name="kantoArray[]" value="Zürich" >
                                    <label class="form-check-label" for="Zürich"
                                    @if (strpos($data['kantons'], 'Zürich') !== false) checked @endif>Zürich</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="Ausland" name="kantoArray[]" value="Ausland" 
                                    @if (strpos($data['kantons'], 'Ausland') !== false) checked @endif>
                                    <label class="form-check-label" for="Ausland">Ausland</label>
                                </div><br>
                                <small class="text-danger">Zug,Zürich,Aargau is necessary cannot be changed</small>
                            </div>
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