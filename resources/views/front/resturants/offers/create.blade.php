@extends('front.layouts.app')
@section('content')



    <section class="shadow add_offer text-center footer-bottom">
        <form action="{{route('offer.store')}}" class="container" enctype="multipart/form-data" method="post">
            @csrf
            @include('front.partials.error')
            <div class="form-group">
                <!-- <div class="shadow text-center d-inline-block selector-img" >
                  <input type="file"/>
                </div> -->
                <!-- //////////////////////////////////////////// -->
                <div class="img-input ">
                    <div class="img shadow">
                        <img src="{{asset('front/images/default-image.jpg')}}" alt="">
                        <input type="file" name="image" id="product_image" accept="image/png,image/jpg,image/jpeg">
                    </div>
                </div>
                <!-- /////////////////////////////////////////// -->
                <h3>صورة العرض</h3>
            </div>
            <div class="form-group">
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="اسم العرض">
            </div>
            <div class="form-group">
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" placeholder="وصف مختصر" rows="5"></textarea>
            </div>
{{--            <div class="form-group ">--}}
{{--                <input  type="text" class="form-control" id="exampleFormControlInput1" placeholder="السعر">--}}
{{--            </div>--}}
            <div class="form-group d-inline-block ">
                <div class="input-group date" >
                    <input name="from" type="date" class=" datetimepicker-input" placeholder="من" />
                </div>
            </div>
            <div class="form-group d-inline-block mr-3">
                <div class="input-group date" >
                    <input name="to" type="date" class="datetimepicker-input" placeholder="الي" />
                </div>
            </div>
            <div class="form-group">
                <button type="submit">اضافة</button>
            </div>
        </form>

    </section>
@endsection
