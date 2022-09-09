@extends('admin.layouts.app')

@inject('resturant','App\Models\Resturant')
@inject('client','App\Models\Client')


@section('content')

@section('page_title')
    Dashboard
@endsection()



<!-- Main content -->
<section class="content">

    <div class="row">
{{--        <div class="col-md-3 col-sm-6 col-12">--}}
{{--            <div class="info-box">--}}
{{--                <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>--}}

{{--                <div class="info-box-content">--}}
{{--                    <span class="info-box-text">Users</span>--}}
{{--                    <span class="info-box-number">{{$client->count()}}</span>--}}
{{--                </div>--}}


{{--                <!-- /.info-box-content -->--}}
{{--            </div>--}}
{{--            <!-- /.info-box -->--}}
{{--        </div>--}}
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$resturant->count()}}</h3>

                    <p>Resturants</p>
                </div>
                <div class="icon">
                    <i class="fas fa-1x fa-utensils"></i>
                </div>
                <a href="{{url('admin/resturant')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$client->count()}}</h3>

                    <p>Clients</p>
                </div>
                <div class="icon">
                    <i class="fas fa-1x fa-user"></i>
                </div>
                <a href="{{url('admin/client')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>    </div>


</section>
<!-- /.content -->
@endsection
