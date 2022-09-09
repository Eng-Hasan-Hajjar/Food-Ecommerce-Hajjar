@extends('front.layouts.app')
@section('content')


    <!-- start section evaluation -->
    <section class="footer-bottom evaluation flex-column d-flex align-items-center justify-content-center">
        <img src="{{asset('images/profile/'.$restaurant->image)}}" style="border-radius: 6%;    width: 30%">
        <div class="star">
            <ul class="list-unstyled">
                @for($i=1;$i<=5;$i++)
                    <li><span><i class="fas  fa-star  @if($restaurant->review >= $i) activ-star @endif"></i></span></li>
                @endfor
            </ul>
        </div>
    </section>
    <section class="meals">
        <div class="container-fluid">
            <div class="text-center div-top ">
                <a class="add-link" href="{{url('resturant/product/create')}}">
                    <button> اضافة منتج جديد</button>
                </a>
            </div>
            <div class="row">
                @if(count($products))
                    @foreach($products as $product)
                        <div class="col p-2 col-md-4 col-sm-6 col-12">
                            <div class="card ">
                                <img class="card-img-top" height="400"
                                     src="{{asset('images/products/'.$product->image)}}" alt="Card image cap">
                                <div class="card-body pt-2">
                                    <h3 class="card-title text-center ">{{$product->name}}</h3>
                                    <p class="card-text text-center"><small
                                            class="text-muted">{{$product->description}}</small></p>
                                    <div class="price text-right"><img src="{{asset('front/images/piggy-bank.png')}}">
                                        @if ($product->offering_price)
                                            <del><span> {{$product->price}} </span> دولار
                                            </del>
                                            <span class="mr-4"> {{$product->offering_price}} </span> دولار
                                        @else
                                            <span>  {{$product->price}} </span> دولار
                                        @endif
                                    </div>
                                </div>
                                <span class="icon-clear">
                            <button type="submit" class="deleteProduct">
                                <i class="fas fa-times-circle"></i>
                                     <form method="POST" action="{{url('resturant/product/'.$product->id)}}"
                                           style="display: none">
                                         @csrf
                                         @method('DELETE')
                                   </form>
                            </button></span>
                                <span class="icon-add"><a href="{{url('resturant/product/'.$product->id.'/edit')}}"><i
                                            class="fas fa-toolbox"></i></a></span>

                            </div>
                        </div>
                    @endforeach
            </div>
            <div class="row">
                <div class="col">
                    {{$products->links()}}
                </div>
            </div>

        @else
            <!-- start card -->
                <section class="cart-parend cart-current footer-bottom">
                    <div class="container">
                        <div class="container-local">
                            <div class=" cart">
                                <div class="row">
                                    <div class="col col-sm-7 col-12">
                                        <h3 class="text-left py-3 text-info"> لا يوجد منتجات </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- end card -->
            @endif
        </div>
    </section>


@endsection



