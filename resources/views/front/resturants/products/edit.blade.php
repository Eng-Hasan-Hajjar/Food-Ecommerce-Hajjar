@extends('front.layouts.app')
@section('content')




    <section class="add-new-offer2 ">
        <div class="add-prodect text-center footer-bottom">
            <h2 class="text-center">تعديل منتج  </h2>

            <form class="container shadow" method="post" action="{{url('resturant/product/'.$record->id)}}" enctype="multipart/form-data">
                @include('front.partials.error')
                <input type="hidden" name="id" value="{{$record->id}}">
                @csrf
                @method('PUT')
                <div class="form-group ">
                    <div class="img-input  pt-3">
                        <div class="img ">
                            <img src="{{asset('images/products/'.$record->image)}}" >
                            <input type="file" name="image" id="product_image" accept="image/png,image/jpg,image/jpeg">
                        </div>
                    </div>
                    <!-- /////////////////////////////////////////// -->
                </div>

                <!-- ////sadasas/////////////////////////////////////// -->
                <div class="form-group">
                    <input type="text" name="name" value="{{$record->name}}" class="shadow form-control" required  placeholder="اسم المنتج">
                </div>
                <div class="form-group">
                    <textarea class="shadow form-control" name="description" required  placeholder="وصف مختصر" rows="5">
                                            {{$record->description}}
                    </textarea>
                </div>
                <div class="form-group ">
                    <input type="number" class="shadow form-control" value="{{$record->price}}" name="price" required  placeholder="السعر">
                </div>
                <div class="form-group ">
                    <input type="number" class="shadow form-control" value="{{$record->offering_price}}" name="offering_price"   placeholder="السعر في  العرض ">
                </div>
                <div class="form-group">
                    <input type="number" class="shadow form-control" value="{{$record->duratrion}}" name="duratrion" required  placeholder=" مدة التجهيز">
                </div>
                <!-- ////sadas/////////////////////////////////////// -->


                <div class="form-group">
                    <button class="btn btn-danger">تعديل</button>
                </div>
            </form>
        </div>
    </section>

@endsection
