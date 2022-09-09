@extends('front.layouts.app')
@section('content')


    <!-- /.card -->
    <section class="content my-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title float-right">
                               بيانات المتقدمين  علي  الوظيفة
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            {{$dataTable->table(['class'=>'table table-bordered table-striped dataTable text-right dtr-inline'])}}

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>



@endsection

@push('css')

    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/fixedColumns.dataTables.min.css')}}">
@endpush

@push('js')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.fixedColumns.min.js')}}">
{{$dataTable->scripts()}}
@endpush
