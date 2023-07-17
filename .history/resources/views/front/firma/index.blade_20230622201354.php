@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Firmalar</h1>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-heading clearfix">
                        <h5>Produkteliste
                        </h5>
                    </div>
                    <!-- /.widget-heading -->
                    <div class="widget-body clearfix">
                        <table id="example" class="table table-striped table-responsive">
                            <thead>
                                <tr class="text-dark">
                                    <th>Produktname</th>
                                    <th>Kaufpreis</th>
                                    <th>Mietepreis</th>
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