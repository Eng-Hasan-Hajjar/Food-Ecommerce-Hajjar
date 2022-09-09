@extends('admin.layouts.app')

@inject('city','App\Models\City')
@section('content')


@section('page_title')
    Districts
@endsection()


<!-- Main content -->


<!-- /.card -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{url("/admin/district/create")}}" class="btn btn-block btn-primary">
                                <span class="fa fa-1x fa-plus">Add district</span>
                            </a>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                          {{$dataTable->table(['class'=>'table table-bordered table-striped dataTable dtr-inline'])}}

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








@push('js')
    <!-- page script -->
        {{$dataTable->scripts()}}
@endpush
<!-- /.content -->
@endsection
