@extends('front.layouts.app')
@section('content')



    <section class="add-new-offer2 ">
        <div class="add-prodect text-center footer-bottom">
            <h2 class="text-center">اضافة منتج جديد </h2>

            <form class="container shadow" method="post" action="{{url('resturant/product')}}" enctype="multipart/form-data">
                @include('front.partials.error')
                @csrf
                <div class="form-group ">
                    <div class="img-input  pt-3">
                        <div class="img ">
                            <img src="{{asset('front/images/default-image.jpg')}}" alt="">
                            <input type="file" name="image" id="product_image" accept="image/png,image/jpg,image/jpeg">
                        </div>
                    </div>
                    <!-- /////////////////////////////////////////// -->
                </div>

                <!-- ////sadasas/////////////////////////////////////// -->
                <div class="form-group">
                    <input type="text" name="name" class="shadow form-control" required  placeholder="اسم المنتج">
                </div>
                <div class="form-group">
                    <textarea class="shadow form-control" name="description" required  placeholder="وصف مختصر" rows="5"></textarea>
                </div>
                <div class="form-group ">
                    <input type="number" class="shadow form-control" min="1" name="price" required  placeholder="السعر">
                </div>
                <div class="form-group ">
                    <input type="number" class="shadow form-control" min="1" name="offering_price"   placeholder="السعر في  العرض ">
                </div>
                <div class="form-group">
                    <input type="number" class="shadow form-control" min="1" name="duratrion" required  placeholder=" مدة التجهيز">
                </div>
                <!-- ////sadas/////////////////////////////////////// -->


                <div class="form-group">
                    <button class="btn btn-danger">اضافة</button>
                </div>
            </form>
        </div>
    </section>
@endsection
