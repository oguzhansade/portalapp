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
                <h1>Firmalar</h1>
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
                        <h5>Firma Listesi</h5>
                    </div>
                    <!-- /.widget-heading -->
                    <div class="widget-body clearfix">
                        <table id="example" class="table table-striped table-responsive">
                            <thead>
                                <tr class="text-dark">
                                    <th>Customer</th>
                                    <th>Firma</th>
                                    <th>Offer Type</th>
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
        $(document).ready(function() {
            let table = $('#example').DataTable({
                lengthMenu: [
                    [25, 100, -1],
                    [25, 100, "All"]
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
                        d.startDate = $('#datepicker_from').val();
                        d.endDate = $('#datepicker_to').val();
                    }
                },
                columns: [{
                        data: 'customerName',
                        name: 'customerName'
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
        });
    </script>
@endsection
