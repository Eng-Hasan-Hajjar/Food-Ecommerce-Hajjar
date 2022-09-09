@extends('front.layouts.app')
@section('content')



    <section class="meals">
        <div class="container-fluid">
            <div class="text-center div-top ">
                <a class="add-link" href="{{url('resturant/offer/create')}}"><button > اضافة عرض جديد </button></a>
            </div>
            <div class="row">
                @if(count($offers))
                    @foreach($offers as $offer)
                        <div class="p-2  col-sm-6 col-12">
                            <div class="card " >
                                <img class="card-img-top" src="{{asset('images/offers/'.$offer->image)}}" alt="Card image cap">
                                <div class="card-body pt-2">
                                    <h3 class="card-title text-center ">{{$offer->name}}</h3>
                                    <p class="card-text text-center"><small class="text-muted">{{$offer->description}}</small></p>
                                </div>
                                <span class="icon-clear">
                              <button type="submit" class="deleteOffer">
                                <i class="fas fa-times-circle"></i>
                                     <form method="POST" action="{{url('resturant/offer/'.$offer->id)}}"
                                           style="display: none">
                                         @csrf
                                         @method('DELETE')
                                   </form>
                            </button></span>
                                <span class="icon-add"><a href="{{url('resturant/offer/'.$offer->id.'/edit')}}"><i class="fas fa-toolbox"></i></a></span>

                            </div>
                        </div>
                    @endforeach
            </div>
            <div class="row">
                <div class="col">
                    {{$offers->links()}}
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
                                            <h3 class="text-left py-3 text-info"> لا يوجد عروض </h3>
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
