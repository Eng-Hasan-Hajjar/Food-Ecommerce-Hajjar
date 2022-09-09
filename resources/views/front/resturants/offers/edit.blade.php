@extends('front.layouts.app')
@section('content')




    <section class="shadow add_offer text-center footer-bottom">
        <form method="post" action="{{url('resturant/offer/'.$record->id)}}" class="container" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$record->id}}">
            @include('front.partials.error')
            <div class="form-group">
                <!-- <div class="shadow text-center d-inline-block selector-img" >
                  <input type="file"/>
                </div> -->
                <!-- //////////////////////////////////////////// -->
                <div class="img-input ">
                    <div class="img shadow">
                        <img src="{{asset('images/offers/'.$record->image)}}" alt="offers">
                        <input name="image" type="file" name="product_image" id="product_image">
                    </div>
                </div>
                <!-- /////////////////////////////////////////// -->
                <h3>صورة العرض</h3>
            </div>
            <div class="form-group">
                <input type="text" name="name" value="{{$record->name}}" class="form-control" id="exampleFormControlInput1" placeholder="اسم العرض">
            </div>
            <div class="form-group">
                <textarea name="description"  class="form-control" id="exampleFormControlTextarea1" placeholder="وصف مختصر" rows="5">
                    {{$record->description}}
                </textarea>
            </div>
            <div class="form-group d-inline-block ">
                <div class="input-group date" >
                    <input name="from" value="{{$record->from}}" type="date" class=" datetimepicker-input" placeholder="من" />
                </div>
            </div>
            <div class="form-group d-inline-block mr-3">
                <div class="input-group date" >
                    <input name="to" type="date" value="{{$record->to}}" class="datetimepicker-input" placeholder="الي" />
                </div>
            </div>
            <div class="form-group">
                <button type="submit">تعديل</button>
            </div>
        </form>

    </section>

@endsection
