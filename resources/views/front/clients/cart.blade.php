
@extends('front.layouts.app')
@section('content')
@section('head')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
    <section class="restaurants " id="section-order">
        <!--start  div all cards -->
        <div class="content-card text-md-right text-center">
            <div class="container">
                <div class="row">
                @if(session()->has('cart') && count($cart->items))
                    @foreach($cart->items as $product)
                    <!--start one card -->
                    <div class=" col col-md-6 col-12">
                        <div class="back-color">
                            <div class="row">
                                <!--  start box -->
                                <div class="col-sm-5 col-12">
                                    <img class="w-100  rounded-pill " height="200px"  src="{{asset('images/products/'.$product['item']['image'])}}">
                                </div>
                                <div class="col-sm-5 col-lg-5 col-md-7 col-12">
                                    <h2 class="h1">{{$product['item']['name']}}</h2>
                                    <h5><span> @if($product['item']['offering_price']) {{$product['item']['offering_price']}} @else {{$product['item']['price']}}  @endif دولار </span></h5>
                                   <div class="form-row">
                                       <div class="col">
                                           <h3>الكميه : </h3>
                                       </div>
                                       <div class="col">
                                           <select class="form-control Quantity" data-product-id="{{ $product['item']['id'] }}">
                                               @for($v=1;$v<=10;$v++)
                                                   <option @if($product['qty'] == $v) selected @endif value="{{$v}}">{{$v}}</option>
                                                   @endfor
                                           </select>
                                       </div>
                                   </div>
                                    <button data-product-id="{{ $product['item']['id'] }}"  data-toggle="modal" data-target="#deleteOrder" class="btn btn-danger mt-5  float-left">مسح</button>
                                </div>
                                <!--  end box -->
                            </div>
                        </div>
                    </div>
                    <!-- end one card -->
                    @endforeach
                    <div class="col-12 justify-content-center d-flex pt-5">
                        <h2 class="h1">المجموع الكلي </h2>
                    </div>
                     <div class="col-12 justify-content-center d-flex">
                        <span class="btn  btn-info px-4 my-4"> <span id="total">{{ $cart->totalPrice }}</span>  $</span>
                    </div>
                        <div class="col-12 justify-content-center d-flex mt-5">
                            <button type="button" id="submitOrder"  class="btn-block btn btn-success mx-5">تاكيد الطلب
                            </button>
                            <a href="{{url('/')}}" type="button" class="btn-block btn btn-danger mx-5">طلب المزيد</a>
                    </div>

                    @else
                        <section class="cart-parend cart-current footer-bottom">
                            <div class="container">
                                <div class="container-local">
                            <!-- start card -->
                            <div class=" cart">
                                <div class="row">
                                    <div class="col col-sm-8 col-12 ">
                                        <h3 class="text-left pl-5 py-3 text-info">السله فارغة  </h3>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                        </section>
                            <!-- end card -->
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- end div all cards -->
    </section>



    <div class="modal fade" id="deleteOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-right">
                    <div class="row">
                        <div class="col-10">
                            <p class="text-bold text-danger"> هل تريد حذف هذا الطلب</p>
                        </div>
                        <div class="col-2 float-right">
                            <button  class="btn btn-sm btn-secondary" data-dismiss="modal">الغاء</button>
                        </div>

                    </div>
                    <form id="deleteOrderForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=" btn btn-danger ">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    @endsection
