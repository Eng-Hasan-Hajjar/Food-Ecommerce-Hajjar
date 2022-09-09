@extends('admin.layouts.app')


@section('content')

@section('page_title')
    Offers
@endsection()


<!-- Main content -->

<!-- /.card -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">

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



<!-- /.content -->

<!-- /.content -->



@push('js')
    <!-- page script -->
    {{$dataTable->scripts()}}
@endpush

@endsection
