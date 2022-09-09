@extends('front.resturants.orders.layout')

@section('nav')
    <div class="row">
        <div class="col-9 pt-3 my3 mr-5">
            @include('front.partials.error')

        </div>
    </div>
    <section class="cart-parend cart-current footer-bottom">
        <div class="container">
            <div class="container-local">
            @if(count($orders))
                @foreach($orders as $order)
                    <!-- start card -->
                        <div class=" cart">
                            <div class="row">
                                <div class="col col-sm-4 col-12 "><img class="w-100"
                                                                       src="{{asset('images/profile/'.$order->client->image)}}">
                                </div>
                                <div class="col col-sm-8 col-12 text-right pr-sm-0">
                                    <h3 class="h2 mt-sm-3 mt-1"> اسم العميل : <span>{{$order->client->name}}</span></h3>
                                    <div class="text-cart">
                                        <div> رقم الطلب : <span>{{$order->id}}</span></div>
                                        <div>المجموع : <span>{{$order->total}} </span> ريال</div>
                                        <div> العنوان : <span> {{$order->address}} - {{$order->client->district->get()[0]->name}} -  {{$order->client->district->city->get()[0]->name}}  </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col  col-12  text-center mt-4">
                                    <div class="row">
                                        <div class="col  col-sm-6 col-12 ">
                                            <button type="button" class="btn btn-info" onclick="window.location = 'tel:{{$order->client->phone}}'">
                                                {{$order->client->phone}} <i class="fas fa-phone"></i> </button>

                                        </div>
                                        <div class="col   col-sm-6 col-12">
                                            <button type="button" class="btn btn-success "
                                                    onclick="event.preventDefault();
                                                    document.getElementById('delivered-form').submit();"> تاكيد الاستلام
                                                <i class="fas fa-thumbs-up"></i>
                                            </button>
                                            <form id="delivered-form" action="{{ route('deliveredR') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                            </form>
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
                            <div class="col col-sm-8 col-12 pr-sm-0">
                                <h3 class="text-left py-3 text-info "> لا يوجد طلبات حاليا </h3>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                @endif
            </div>
        </div>
    </section>

@endsection
