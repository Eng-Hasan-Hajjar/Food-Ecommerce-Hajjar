
@extends('front.layouts.app')
@section('content')

    <!-- start section evaluation -->

    <section class="meals">
        <div class="container-fluid">
            <div class="row">
                @if(count($products))
                    @foreach($products as $product)
                        <div class="col p-2 col-md-4 col-sm-6 col-12">
                            <div class="card " >
                                <img class="card-img-top" height="400" src="{{asset('images/products/'.$product->image)}}" alt="Card image cap">
                                <div class="card-body pt-2">
                                    <h3 class="card-title text-center ">{{$product->name}}</h3>
                                    <p class="card-text text-center"><small class="text-muted">{{$product->description}}</small></p>
                                    <div class="price text-right"><img  src="{{asset('front/images/piggy-bank.png')}}"><span> مدة التجهيز :</span>  {{$product->duratrion}}  دقيقة تقريبا </div>
                                    <div class="price text-right"><img  src="{{asset('front/images/piggy-bank.png')}}">
                                        <span>السعر : </span>
                                        @if ($product->offering_price)
                                            <del><span> {{$product->price}} </span> ريال
                                            </del>
                                            <span class="mr-4"> {{$product->offering_price}} </span> ريال
                                        @else
                                            <span>  {{$product->price}} </span> ريال
                                        @endif
                                    </div>
                                </div>
                                @if(session()->has('cart') && array_key_exists($product->id , session()->get('cart')->items))
                                    <span class="icon-clear">
                                  <button disabled="disabled" style="opacity: 0.5;">
                                <i class="fas fa-shopping-cart"></i>
                                 </button>
                            </span>
                                @else
                                    <span class="icon-clear">
                            <button  onclick="document.getElementById('addToCart-form{{$product->id}}').submit();" >
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                             <form id="addToCart-form{{$product->id}}" action="{{ url('add-cart/'.$product->id) }}" method="POST" style="display: none;">
                                  @csrf
                             </form>
                        </span>
                                @endif


                                <div class="text-center">
                                    <a href="{{url('products/'.$product->id)}}" class="btn btn-md pt-3 more-info my-3"> اضغط للتفاصيل</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                <!-- start card -->
                    <section class="cart-parend cart-current footer-bottom">
                        <div class="container">
                            <div class="container-local">
                                <div class=" cart">
                                    <div class="row">
                                        <div class="col col-sm-10 col-12">
                                            <h3 class="text-left  py-3 text-info"> لا يوجد نتائج مطابقه لبحثك حاول مره اخري </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- end card -->
                @endif
            </div>

        </div>

    </section>


@endsection









