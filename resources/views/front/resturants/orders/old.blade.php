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
                                <div class="col col-sm-4 col-12 "> <img class="w-100" src="{{asset('images/profile/'.$order->client->image)}}"> </div>
                                <div class="col col-sm-8 col-12 text-right pr-sm-0">
                                    <h3 class="h2 mt-sm-3 mt-1">  اسم العميل : <span>{{$order->client->name}}</span> </h3>
                                    <div class="text-cart">
                                        <div> رقم الطلب : <span>{{$order->id}}</span></div>
                                        <div>المجموع : <span>{{$order->total}} </span> ريال</div>
                                        <div>  العنوان : <span> {{$order->address}} - {{$order->client->district->get()[0]->name}} -  {{$order->client->district->city->get()[0]->name}}  </span></div>
                                    </div>
                                </div>
                                <div class="col  col-12  text-center mt-4">
                                    <div class="row">

                                        <div class="col  col-12  text-center mt-4">
                                           @if($order->state == 'delivered')
                                                <span class="btn btn-success ">  الطلب مكتمل  </span>
                                               @else
                                                <span class="btn btn-danger ">  الطلب مرفوض  </span>
                                            @endif
                                               <span class="btn btn-info" data-show-id="{{ $order->id }}"
                                                       data-toggle="modal" data-target="#MyModal"> <i class="fas fa-info-circle"></i>   تفاصيل الطلب
                                               </span>
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
                                <h3 class="text-left py-3 text-info "> لا يوجد طلبات   </h3>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                @endif
            </div>
        </div>
    </section>
    <div id="printThis">
        <div id="MyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <!-- Modal Content: begins -->
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="body-message" id="detailData">
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button class="btn mx-3 btn-secondary" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button id="btnPrint" type="button" class="btn btn-primary">Print</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
