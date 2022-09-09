@extends('front.layouts.app')
@section('content')



    <section class="new-offer footer-bottom">
        <div class="container">
            <h2 class="text-center"> العروض  الجديدة</h2>
            @if(count($offers))
                @foreach($offers as $offer)
            <!--start one offer -->
            <div class="one-offer d-flex">
                <div><img src="{{asset('images/offers/'.$offer->image)}}"></div>
                <div>
                    <h6 class="text-bold text-danger">{{$offer->name}}</h6>
                    <p>{{$offer->description}}</p>
                    <a class="d-flex justify-content-center" style="margin: 0 auto" href="{{url('resturants/'.$offer->resturant_id)}}">احصل عليه الان</a>
                </div>
            </div>
            <!-- end one-offer -->
                @endforeach
                    @else
                <!-- start card -->
                    <section class="cart-parend cart-current footer-bottom">
                        <div class="container">
                            <div class="container-local">
                                <div class=" cart">
                                    <div class="row">
                                        <div class="col col-sm-7 col-12">
                                            <h3 class="text-left py-3 text-info"> لا يوجد عروض </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- end card -->
                        @endif
             {{$offers->links()}}
        </div>
    </section>


@endsection









