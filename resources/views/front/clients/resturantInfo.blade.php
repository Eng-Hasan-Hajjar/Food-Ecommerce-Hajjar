
@extends('front.layouts.app')
@section('content')

    <section class="shop-info footer-bottom">
        <div class="container">
            <h2 class="text-center">معلومات عن المتجر</h2>
            <div class="div-img">
                @if($resturant->image)
                <img  src="{{asset('images/profile/'.$resturant->image)}}" >
                @endif
                <h3>{{$resturant->name}}</h3>
            </div>
            <div class="info text-right ">
                <div class="row">
                    <div class="col col-6"> الحالة</div>
                    <div class="col col-6"> @if($resturant->state == 1 && $resturant->active == 1) مفتوح @else مغلق @endif</div>
                </div>

                <div class="row">
                    <div class="col col-6"> المدينة</div>
                    <div class="col col-6"> {{$resturant->district->city->name}}</div>
                </div>
                <div class="row">
                    <div class="col col-6"> الحي</div>
                    <div class="col col-6"> {{$resturant->district->name}}</div>
                </div>

                <div class="row">
                    <div class="col col-6">الحد الادني</div>
                    <div class="col col-6"> {{$resturant->minimum_order}} ريال </div>
                </div>

                <div class="row">
                    <div class="col col-6"> رسوم التوصيل</div>
                    <div class="col col-6"> {{$resturant->delivery_charge}} ريال </div>
                </div>
            </div>
        </div>
    </section>


@endsection









