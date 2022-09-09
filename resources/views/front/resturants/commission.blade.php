

@extends('front.layouts.app')
@section('content')


<section class="command footer-bottom">
    <div class="container">
        <div class="text-center">
            <h2>العمولة</h2>
            <p class="command-p">{{$data['text1']}}</p>
        </div>
        <div class="total text-right">
            <p> مبيعات المطعم :<span >{{$data['sales']}} </span>ريال</p>
            <p> عمولة التطبيق :<span>{{$data['commission']}} </span>ريال</p>
            <p> ما تم سداده :<span>{{$data['paid']}}  </span>ريال</p>
            <p> المتبقي:<span>{{$data['rest']}} </span>ريال</p>
        </div>
        <div class="num-phone text-center">
            <p>الرجحي :<span >{{$data['acc1']}}</span></p>
            <p> الاهلي :<span>{{$data['acc2']}}</span></p>
            <p>{{$data['text2']}}</p>
        </div>
    </div>
</section>


    @endsection
