@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet"
        type="text/css">
    
    {{-- DataTable Stilleri --}}
    <style>
        /* DataTables
                ========================*/
        .dataTables_wrapper label {
            font-weight: normal;
        }

        .dataTables_wrapper .dataTables_filter input {
            padding: 0.35714em 0.71429em;
            border: 0.0625rem solid #eee;
            border-radius: 0.125rem;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #03a9f3;
        }

        .dataTables_wrapper .dataTables_length {
            margin: 1.07143em auto;
        }

        .dataTables_wrapper .dataTables_length select {
            padding: 0.21429em 0.5em;
        }

        .dataTables_wrapper table.dataTable {
            border: 0.0625rem solid #eee;
            margin-top: 1.42857em;
        }

        .dataTables_wrapper table.dataTable thead th {
            border-color: #eef1f2;
        }

        .dataTables_wrapper table.dataTable th,
        .dataTables_wrapper table.dataTable td {
            padding: 1.07143em 1.42857em;
        }

        .dataTables_wrapper table.dataTable tfoot th {
            border-top: 0.0625rem solid #eee;
        }

        .dataTables_wrapper table.dataTable thead th {
            border-top: 0;
        }

        .dataTables_wrapper table.dataTable thead .sorting,
        .dataTables_wrapper table.dataTable thead .sorting_asc,
        .dataTables_wrapper table.dataTable thead .sorting_desc {
            background: none;
            position: relative;
        }

        .dataTables_wrapper table.dataTable thead .sorting:before,
        .dataTables_wrapper table.dataTable thead .sorting_asc:before,
        .dataTables_wrapper table.dataTable thead .sorting_desc:before {
            position: absolute;
            top: 50%;
            right: 0.71429em;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            font-family: "Material Icons";
            -webkit-font-feature-settings: 'liga';
            font-feature-settings: 'liga';
            font-size: 1.28571em;
        }

        .dataTables_wrapper table.dataTable thead .sorting_asc::before {
            content: 'expand_less';
        }

        .dataTables_wrapper table.dataTable thead .sorting_desc::before {
            content: 'expand_more';
        }

        .dataTables_wrapper table.dataTable thead .sorting::before {
            content: 'sort';
            opacity: 0.1;
        }

        .dataTables_wrapper .dataTables_info {
            margin-top: 1.42857em;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 2.14286em;
            padding: 0;
            border: 0.0625rem solid #eee;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
            border: 0;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: none;
            border: 0;
            color: #999 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:focus {
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #8253eb;
            border: 0;
            border-radius: 0;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #6125e6;
            border: 0;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.next,
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous {
            border: 0;
        }
    </style>
    {{-- DataTable Stilleri --}}

    <style>
        .btn-detail {
            transition: all 0.3s ease;
            background-color: #8253eb;
            color:white;
        }
        .btn-detail:hover {
            color:white;
            background-color: #6125E6;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Offerte</h1>
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

        @if (session("status2"))
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        {{ session("status2") }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <h5>Angebotsliste</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <table border="0" class="text-dark" cellspacing="5" cellpadding="5" >
                                <tbody>
                                    <tr>
                                        <td><b class="test-dark">Erfasst</b></td>
                                        <td align="left"><input class="form-control" type="date" id="start_date" name="min_date"></td>
                                        <td><b class="test-dark">bis</b></td>
                                        <td><input class="form-control" type="date" id="end_date" name="max_date"></td>
                                        <td><button id="reset" class="btn btn-danger">Zurücksetzen</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b class="test-dark">Stand</b>
                                            
                                          
                                        </td>
                                        <td colspan="2">
                                            <select class="form-control" name="status" id="status">
                                                <option value="Alle">Gesamt</option>
                                                <option value="Aktif">Aktiv</option>
                                                <option value="Pasif">Storniert</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5">
                                            <button class="btn btn-primary" onclick="openFilter()" type="button" data-toggle="collapse" data-target="#checkbox-container" aria-expanded="false" aria-controls="checkbox-container">
                                                Zimmer Filters
                                              </button>
                                            <div id="checkbox-container" class="collapse">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input zimmerFilter" onclick="updateCheckedValues()"  type="checkbox" id="checkbox1" name="zimmerFilter[]" value="1 Zimmer / Raum" >
                                                    <label class="form-check-label" for="checkbox1">1 Zimmer / Raum</label>
                                                </div>
                                                <div class="form-check form-check-inline zimmerFilter">
                                                    <input class="form-check-input"  type="checkbox" onclick="updateCheckedValues()" id="checkbox2" name="zimmerFilter[]" value="1.5 Zimmer / Räume" >
                                                    <label class="form-check-label" for="checkbox2">1.5 Zimmer / Räume</label>
                                                </div>
                                                <div class="form-check form-check-inline zimmerFilter">
                                                    <input class="form-check-input"  type="checkbox" onclick="updateCheckedValues()" id="checkbox3" name="zimmerFilter[]" value="2 Zimmer / Räume" >
                                                    <label class="form-check-label" for="checkbox3">2 Zimmer / Räume</label>
                                                </div>
                                                <div class="form-check form-check-inline zimmerFilter">
                                                    <input class="form-check-input"  type="checkbox" onclick="updateCheckedValues()" id="checkbox4" name="zimmerFilter[]" value="2.5 Zimmer / Räume" >
                                                    <label class="form-check-label" for="checkbox4">2.5 Zimmer / Räume</label>
                                                </div>
                                                <div class="form-check form-check-inline zimmerFilter">
                                                    <input class="form-check-input"  type="checkbox" onclick="updateCheckedValues()" id="checkbox5" name="zimmerFilter[]" value="3 Zimmer / Räume" >
                                                    <label class="form-check-label" for="checkbox5">3 Zimmer / Räume</label>
                                                </div>
                                                <div class="form-check form-check-inline zimmerFilter">
                                                    <input class="form-check-input"  type="checkbox" onclick="updateCheckedValues()" id="checkbox6" name="zimmerFilter[]" value="3.5 Zimmer / Räume" >
                                                    <label class="form-check-label" for="checkbox6">3.5 Zimmer / Räume</label>
                                                </div>
                                                <div class="form-check form-check-inline zimmerFilter">
                                                    <input class="form-check-input"  type="checkbox" onclick="updateCheckedValues()" id="checkbox7" name="zimmerFilter[]" value="4 Zimmer / Räume" >
                                                    <label class="form-check-label" for="checkbox7">4 Zimmer / Räume</label>
                                                </div>
                                                <div class="form-check form-check-inline zimmerFilter">
                                                    <input class="form-check-input"  type="checkbox" onclick="updateCheckedValues()" id="checkbox8" name="zimmerFilter[]" value="4.5 Zimmer / Räume" >
                                                    <label class="form-check-label" for="checkbox8">4.5 Zimmer / Räume</label>
                                                </div>
                                                <div class="form-check form-check-inline zimmerFilter">
                                                    <input class="form-check-input"  type="checkbox" onclick="updateCheckedValues()" id="checkbox9" name="zimmerFilter[]" value="5 Zimmer / Räume" >
                                                    <label class="form-check-label" for="checkbox9">5 Zimmer / Räume</label>
                                                </div>
                                                <div class="form-check form-check-inline zimmerFilter">
                                                    <input class="form-check-input"  type="checkbox" onclick="updateCheckedValues()" id="checkbox10" name="zimmerFilter[]" value="5.5 Zimmer / Räume" >
                                                    <label class="form-check-label" for="checkbox10">5.5 Zimmer / Räume</label>
                                                </div>
                                                <div class="form-check form-check-inline zimmerFilter">
                                                    <input class="form-check-input"  type="checkbox" onclick="updateCheckedValues()" id="checkbox11" name="zimmerFilter[]" value="6 Zimmer / Räume" >
                                                    <label class="form-check-label" for="checkbox11">6 Zimmer / Räume</label>
                                                </div>
                                                <div class="form-check form-check-inline zimmerFilter">
                                                    <input class="form-check-input"  type="checkbox" onclick="updateCheckedValues()" id="checkbox12" name="zimmerFilter[]" value="6.5 Zimmer / Räume" >
                                                    <label class="form-check-label" for="checkbox12">6.5 Zimmer / Räume</label>
                                                </div>
                                                <div class="form-check form-check-inline zimmerFilter">
                                                    <input class="form-check-input"  type="checkbox" onclick="updateCheckedValues()" id="checkbox13" name="zimmerFilter[]" value="mehr als 6.5 Zimmer / Räume" >
                                                    <label class="form-check-label" for="checkbox13">mehr als 6.5 Zimmer / Räume</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 text-white bg-primary shadow rounded">
                                <table style="font-size:1rem">
                                    <tr>
                                        <td><span>Gesamt</span></td>
                                        <td>: <span id="toplamTeklif"></span></td>
                                    </tr>
                                    <tr>
                                        <td><span>Aktiv</span></td>
                                        <td>: <span id="aktifTotal"></span></td>
                                
                                    </tr>
                                    <tr>
                                        <td><span>Storniert</span></td>
                                        <td>: <span id="pasifTotal"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- /.widget-heading -->
                    <div class="widget-body clearfix mt-3">
                        <table id="example" class="table table-striped table-responsive">
                            <thead>
                                <tr class="text-dark">
                                    <th>Customer</th>
                                    <th>Offerte Number</th>
                                    <th>Firmas</th>
                                    <th>Type</th>
                                    <th>Zimmer</th>
                                    <th>Datum</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
        </div>
    </div>
@endsection

@section('footer')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
   
    <script>    
       function openFilter() {
    var checkboxContainer = $('#checkbox-container');
    
    if (checkboxContainer.css('display') === 'none') {
        checkboxContainer.slideDown(300); // 300ms içinde yukarı aç
    } else {
        checkboxContainer.slideUp(300);   // 300ms içinde yukarı kapat
    }
}
        
    </script>
    <script>
        let checkedValues = [];

        function updateCheckedValues() {
            const checkboxIds = [
                'checkbox1', 'checkbox2', 'checkbox3', 'checkbox4', 
                'checkbox5', 'checkbox6', 'checkbox7', 'checkbox8', 
                'checkbox9', 'checkbox10', 'checkbox11', 'checkbox12', 'checkbox13'
            ];

            checkboxIds.forEach(checkboxId => {
                const checkbox = document.getElementById(checkboxId);
                checkbox.addEventListener('change', () => {
                    const index = checkedValues.indexOf(checkbox.value);
                    if (checkbox.checked && index === -1) {
                        checkedValues.push(checkbox.value);
                    } else if (!checkbox.checked && index !== -1) {
                        checkedValues.splice(index, 1);
                    }
                });
            });
        }


        $(document).ready(function() {
            

            let table = $('#example').DataTable({
                lengthMenu: [
                    [25, 100, -1],
                    [25, 100, "All"]
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: '{{ route('offerList.data') }}',
                    data: function(d) {
                        d.min_date = $('#start_date').val();
                        d.max_date = $('#end_date').val();
                        d.status = $('#status').val();
                        d.zimmerFilter = checkedValues;
                        return d
                    }
                },
                order: [[ 1, "desc" ]],
                columns: [{
                        data: 'customerName',
                        name: 'customerName'
                    },
                    {
                        data: 'offerId',
                        name: 'offerId'
                    },
                    {
                        data: 'firma',
                        name: 'firma'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'zimmer',
                        name: 'zimmer'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'option',
                        name: 'option',
                        orderable: false,
                        searchable: false
                    },
                ],

                "footerCallback": function ( row, data, start, end, display ) {
                    var rsTot = table.ajax.json();    
                    var api = this.api(), data;
                    console.log(rsTot)
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
    
                    ent = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
            
                    $( api.column( 4 ).footer() ).html(ent);
                    if(rsTot.aktifTotal)
                    {
                        let aktifTotal = rsTot.aktifTotal;
                        $('#aktifTotal').text(aktifTotal);

                        if(rsTot.pasifTotal)
                        {
                            let pasifTotal = rsTot.pasifTotal;
                            $('#pasifTotal').text(pasifTotal);
                        }
                        
                    }
                
                    $('#toplamTeklif').text(rsTot.recordsFiltered + '/' + rsTot.toplamTeklif);
                }    

            });
            jQuery.fn.DataTable.ext.type.search.string = function(data) {
                var testd = !data ?
                    '' :
                    typeof data === 'string' ?
                    data
                    .replace(/i/g, 'İ')
                    .replace(/ı/g, 'I') :
                    data;
                return testd;
            };
            $('#example_filter input').keyup(function() {
                table
                    .search(
                        jQuery.fn.DataTable.ext.type.search.string(this.value)
                    )
                    .draw();
            });

            $('#start_date, #end_date, #status').on('change', function() {
                table.draw();
            });

            $('#checkbox-container').on('change', function () {
                table.draw();
                console.log(checkedValues,'çekbox değerleri')
            })

            $('#reset').on('click', function() {
                $('#start_date').val('');
                $('#end_date').val('');
                table.draw();
            });
        });
    </script>

<script>
   function statusChanger(id, type) {
    if (confirm("Are you sure you want to change the status?")) {
        confirmAndChange(id, type);
    }
}
</script>
<script>
    function cancelOffer(id, type) {
     if (confirm("Teklifi iptal etmek istediğinizden emin misiniz? (İlgili firmalara mail gider)")) {
         confirmAndCancel(id, type);
     }
 }
 </script>
 <script>
    function confirmAndCancel(id,type){
    let table= $('#example').DataTable();
    
     console.log(id,type);
         $.ajax({
             type:'POST',
             headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
             url: '{{ route('offerList.cancelOffer', ['id' => ':id', 'type' => ':type']) }}'.replace(':id', id).replace(':type', type),
             success: function(response) {
                table.draw();
             },
             error: function(xhr, status, error) {
                 // handle error response
             }
         });
     }
 </script>
<script>
   function confirmAndChange(id,type){
   let table= $('#example').DataTable();
   
    console.log(id,type);
        $.ajax({
            type:'POST',
            headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
            url: '{{ route('offerList.statusChanger', ['id' => ':id', 'type' => ':type']) }}'.replace(':id', id).replace(':type', type),
            success: function(response) {
               table.draw();
            },
            error: function(xhr, status, error) {
                // handle error response
            }
        });
    }
</script>
@endsection
