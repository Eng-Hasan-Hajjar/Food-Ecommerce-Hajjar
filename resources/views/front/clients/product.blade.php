
@extends('front.layouts.app')
@section('content')

    <!-- start section evaluation -->
    <section class="meal-top footer-bottom">
        <div class="container">
            <figure>
                <img class="w-100 " style="max-height: 500px;border-radius: 4%" src="{{asset('images/products/'.$product->image)}}">
                <caption>
                    <h2 class="text-center">{{$product->name}}</h2>
                    <p class="text-center">{{$product->description}}</p>
                    <ul class="list-unstyled text-right pr-0">
                        <li> <img class="img-mony" src="{{asset('front/images/piggy-bank.png')}}">
                            السعر :  @if ($product->offering_price)
                                <del><span> {{$product->price}} </span> ريال
                                </del>
                                <span class="mr-4"> {{$product->offering_price}} </span> دولار
                            @else
                                <span>  {{$product->price}} </span> دولار
                            @endif
                        </li>
                        <li><i class="far fa-clock"></i> مدة تجهيز الطلب:{{$product->duratrion}} دقيقة</li>
                        <li><i class="fas fa-coins"></i> رسوم التوصيل : {{$product->resturant->delivery_charge}}دولار </li>

                    </ul>
                </caption>
            </figure>
            <hr class="mt-5 mb-3">
        </div>
    </section>

    <section class="evaluations">
        <div class="container">
            <div class="text-center button-focus">
                <button onclick="document.getElementById('addToCart-form{{$product->id}}').submit();">
                    <span>شــــــــــراء</span>
                    <img  class="w-100" src="{{asset('front/images/Group 1039.png')}}">

                    <form id="addToCart-form{{$product->id}}" action="{{ url('add-cart/'.$product->id) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </button>
            </div>
            <h4 class="mb-4 text-right"><i class="fa fa-info-circle"></i> <a href="{{url('resturants/info/'.$product->resturant->id)}}"> معلومات عن هذا المتجر</a> </h4>
            <h3 class="text-right  pr-2 h3-style">تقيم المستخدمين</h3>
            <p class="number text-right"><span>{{count($product->resturant->reviews)}}</span> تقيم</p>
            @if(count($product->resturant->reviews))
                @foreach($product->resturant->reviews as $review)
            <!-- start cart -->
            <div class="cart">
                <div class="star text-center">
                    <ul class="list-unstyled  mb-0 " dir="rtl">
                        @for($i=0;$i<$review->reate;$i++)
                            <li><span><i class="fas  fa-star activ-star"></i></span></li>
                        @endfor
                        @for($i=0;$i<5-$review->reate;$i++)
                            <li><span><i class="fas  fa-star"></i></span></li>
                        @endfor
                    </ul>
                </div>
                <div class="text-right name-user"> بواسطة : <span>{{$review->client->name}}</span></div>
                <p class="text-center ">{{$review->comment}} </p>
            </div>
            <!-- end cart -->
                @endforeach
           @endif
        </div>
    </section>

    <section class="add-evaluation">
        <div class="container">

            <h3 class="text-right pr-2 mb-0 h3-style"> اضف تقييمك</h3>
            <form method="post" action="{{route('review')}}">
                @csrf
                <div class="star rating-stars  text-center">
                    <ul class="list-unstyled  mb-0 " id="stars">
                        <li title='Poor'  data-value='1' class="s" ><span><i class="fas  fa-star"></i></span></li>
                        <li title='Fair'  data-value='2' class="s"><span><i class="fas  fa-star"></i></span></li>
                        <li title='Good'  data-value='3' class="s"><span><i class="fas  fa-star"></i></span></li>
                        <li title='Excellent' data-value='4' class="s"><span><i class="fas  fa-star"></i></span></li>
                        <li title='WOW!!!' data-value='5' class="s"><span><i class="fas  fa-star"></i></span></li>
                        <input type="hidden" name="reate" id="review">
                        <input type="hidden" name="resturant_id" value="{{$product->resturant->id}}">
                    </ul>
                </div>
                <div class="form-group mt-2 ">
                    <textarea class="form-control textarea-focus" name="comment" rows="6"></textarea>
                </div>
                <div class="form-group mt-2 text-center ">
                    <button type="submit">ارسال</button>
                </div>
            </form>
        </div>
    </section>

    @if(count($products))
    <div class="container">
        <h3 class="h3-style text-right pr-2">المزيد من اكلات المطعم</h3>
    </div>
    <section class="slider-meals">
        <div class="container">
            <div class="multiple-items" >
                @foreach($products as $pro)
                <div class="item">
                    <a href="{{url('products/'.$pro->id)}}">
                        <div class="img-div">
                            <img class="w-100" src="{{asset('images/products/'.$pro->image)}}">
                            <div class="more-information" style="opacity: 0">
                                <h2>{{$pro->name}}</h2>
                                <p>اضغط للتفاصيل</p>
                            </div>
                        </div>
                    </a>
                </div>
                 @endforeach
            </div>
        </div>
        </div>
    </section>


    @endif
@endsection









