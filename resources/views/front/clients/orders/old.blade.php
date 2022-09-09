@extends('front.clients.orders.layout')

@section('nav')
    <!-- start section evaluation -->

    <section class="cart-parend footer-bottom">
        <div class="container">
            <div class="container-local">
            @if(count($orders))
                @foreach($orders as $order)
                <!-- start card -->
                <div class=" cart">
                    <div class="row">
                        <div class="col  col-sm-4 col-12 "> <img class="w-100" src="{{asset('images/profile/'.$order->resturant->image)}}"> </div>
                        <div class="col  col-sm-8 col-12 text-right pr-sm-0">
                            <h3 class="h2">{{$order->resturant->name}}</h3>
                            <div class="text-cart">
                                <div> رقم الطلب : <span>{{$order->id}}</span></div>
                                <div>السعر : <span> {{$order->cost}} </span> ريال</div>
                                <div>التوصيل : <span>{{$order->resturant->delivery_charge}} </span> ريال</div>
                                <div>المجموع : <span>{{$order->total}} </span> ريال</div>
                               <div class="pt-2">
                                   @if($order->state == 'delivered')
                                       <span class="btn btn-success ">  الطلب مكتمل  </span>
                                   @else
                                       <span class="btn btn-danger ">  الطلب مرفوض  </span>
                                   @endif
                               </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end card -->
            @endforeach
            @else
                <!-- start card -->
                    <div class=" cart">
                        <div class="row">
                            <div class="col col-sm-8  pr-sm-0">
                                <h3 class="text-left py-3 text-info "> لا يوجد طلبات مكتمله  </h3>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                @endif
            </div>
        </div>

    </section>



@endsection
