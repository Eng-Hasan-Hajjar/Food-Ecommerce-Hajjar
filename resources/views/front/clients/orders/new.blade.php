@extends('front.clients.orders.layout')

@section('nav')
    <div class="row">
        <div class="col-9 pt-3 my3 mr-5">
            @include('front.partials.error')

        </div>
    </div>
    <!-- start section evaluation -->
    <section class="cart-parend footer-bottom">
        <div class="container">
            <div class="container-local">
            @if(count($orders))
                @foreach($orders as $order)
                    <!-- start card -->
                        <div class=" cart">
                            <div class="row">
                                <div class="col col-sm-3 col-12 "><img class="w-100"
                                                                       src="{{asset('images/profile/'.$order->resturant->image)}}">
                                </div>
                                <div class="col col-sm-5 col-12 text-right pr-sm-0">
                                    <h3 class="h2"> {{$order->resturant->name}}</h3>
                                    <div class="text-cart">
                                        <div> رقم الطلب : <span>{{$order->id}}</span></div>
                                        <div>السعر : <span> {{$order->cost}} </span> ريال</div>
                                        <div>التوصيل : <span>{{$order->resturant->delivery_charge}} </span> ريال</div>
                                        <div>المجموع : <span>{{$order->total}} </span> ريال</div>
                                        <div>اتصال : <span> <a
                                                    href='tel:{{$order->client->phone}}'>{{$order->resturant->contact_phone}}</a></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col col-sm-4 col-12  text-center mt-4">
                                    <div class="row">
                                        <div class="col col-sm-12 col-6 ">
                                            @if($order->state == 'accepted')
                                                <button type="button" class="btn btn-success "
                                                        onclick="event.preventDefault();
                                                            document.getElementById('accept-form{{$order->id}}').submit();">
                                                    <i class="fas fa-thumbs-up"></i> استلام
                                                </button>
                                                <form id="accept-form{{$order->id}}" action="{{ route('delivered') }}"
                                                      method="POST" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                                </form>
                                            @elseif($order->state == 'delivered')
                                                <span class="text-success">الطلب مكتمل</span>
                                            @elseif($order->state == 'rejected')
                                                <span class="text-danger">المطعم رفض الطلب</span>
                                            @elseif($order->state == 'pending')
                                                <span class="text-info">في انتظار المطعم</span>
                                            @endif
                                        </div>
                                        <div class="col  col-sm-12 col-6">
                                            <button class="btn btn-info" data-show-id="{{ $order->id }}"
                                                    data-toggle="modal" data-target="#MyModal"><i
                                                    class="fas fa-info-circle"></i> تفاصيل
                                            </button>
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
                            <div class="col col-sm-10  pr-sm-0">
                                <span class="text-left py-3 text-info ">هنا سيتم عرض الطلبات التي تمت  الموافقه او الرفض عليها من قبل  المطعم او الطلبات المكتملة  </span>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                @endif
            </div>

        </div>
    </section>


    <div id="printThis">
        <div id="MyModal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
