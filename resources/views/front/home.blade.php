@extends('front.layouts.app')
@section('content')

    <!-- Start Header Section -->
    <section class="header-img  flex-column d-flex align-items-center justify-content-center">
        <div class="logo">سفرة</div>
        <h2>بتشتري ... بتبيع ؟ كله عند ام ربيع</h2>
        <button id="btn-register">سجل الان</button>
    </section>
    <!-- End Header Section -->
<!-- Start Favs Resturants Section -->
    <section class="restaurants">
        <div class="container">
            <h2 class="text-center h2-top">ابحث عن مطعمك المفضل</h2>
            <form id="res_search">
                <input type="hidden" id="token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col">
                        <div class="icon">
                            <span><i class="fas fa-arrow-down"></i></span>
                            <select id="cityId" name="city"  class="form-control ">
                                <option selected disabled value="0"> اختر المدينة</option>
                            @foreach($city as $c)
                                   <option  value="{{$c->id}}">{{$c->name}}</option>
                                   @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="icon">
                            <button type="submit" class="fas"><i class="fa fa-search"></i></button>
                            <input type="text" id="resturantId" name="resturant" class="form-control" placeholder="ابحث عن مطعمك المفضل">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--start  div all cards -->
        <div class="content-card text-md-right text-center">
            <div class="container">
                <div class="row" id="resturant">
                    @foreach($resturants as $resturant)
                    <!--start one card -->
                    <div class="col-md-6 col-12 ">
                        <div class="back-color">
                            <div class="row">
                                <div class="col-sm-5 col-12">
                                    @if($resturant->image)
                                    <img class="w-100 h-100" style="border-radius:50% " src="{{asset('images/profile/'.$resturant->image)}}">
                                    @endif
                                </div>
                                <div class="col-sm-5 col-lg-5 col-md-7 col-12">
                                    <a href="{{url('resturants/'.$resturant->id)}}" style="
                                     text-decoration-line: none;
                                     color: #ec3454;font-size: 38px;
                                        ">{{$resturant->name}}</a>
                                    <div class="star">
                                        <ul class="list-unstyled" >
                                            @for($i=1;$i<=5;$i++)
                                                <li><span><i class="fas  fa-star  @if($resturant->review >= $i) activ-star @endif"></i></span></li>
                                            @endfor

                                        </ul>
                                    </div>
                                    <p>الحد الادني للطلب:<span>{{$resturant->minimum_order}}ريال</span></p>
                                    <p>رسوم التوصيل :<span>{{$resturant->delivery_charge}}ريال</span></p>
                                </div>
                                <div class=" col-lg-2 col-md-12 col-sm-2 col-12 text-center pr-0  mt-lg-4 mt-0  ">
                                    <div class="test mt-sm-5 mt-lg-5 mt-md-0 mt-0"><span class="span-color"></span> <span class="span-test">مفتوح</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end one card -->
                        @endforeach

                </div>
            </div>
            <div class="row">
                <div class="col-2" style="margin: 10px auto">
                    {{$resturants->links()}}
                </div>
            </div>
        </div>
        <!-- end div all cards -->
    </section>
<!-- End Favs Resturants Section -->

<!-- Start Featues Section -->
    <section class="offers">
        <div class="container">
            <div class="row">
                <div class="col col-md-5 col-12">
                    <div class="img">
                        <img class="w-100" src="{{asset('front/images/Group 1036.png')}}">
                    </div>
                </div>
                <div class="col col-md-7 col-12">
                    <div class="detail">
                        والاكلات الشهية نقدم في سفرةافضل العروض لكل انواع المطاعم ماذا تنتظر ابدا الاستمتاع بالعرض الان
                        <br>
                        <button>شاهد العروض </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End Featues Section -->

<!-- Start Download Section -->
    <section class="download-app">
        <div class="container">
            <h2 class="text-right h1">قم بتحميل التطبيق الخاص بنا الان</h2>
            <div class="row">
                <div class="col col-sm-6 col-12 text-center">
                    <button>حمل الان</button>
                </div>
                <div class="col">
                    <img class="w-100" src="{{asset('front/images/app mockup.png')}}">
                </div>
            </div>
        </div>
    </section>
<!-- End Download Section -->

@endsection

