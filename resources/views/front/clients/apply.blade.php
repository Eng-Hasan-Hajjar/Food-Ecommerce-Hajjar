@extends('front.layouts.app')
@section('content')


    <!-- start section evaluation -->
    <section class="back-body">

        <div class="shadow register-seler register add_offer text-center">
            <form class="container" method="POST" action="{{url('store-apply')}}">
                <div class="form-group text-center">
                    <span class="icon-user">
                        <img src="{{url('images/profile/'.$resturant->image)}}" class="img-circle" alt="image for resturant">
                    </span>
                </div>
                <div class="">
                    <h4>برجاء ملئ كافة البيانات بشكل صحيح</h4>
                </div>
                <input type="hidden" value="{{$resturant->id}}" name="resturant_id">
                @csrf
                @include('front.partials.error')
                <div class="form-group">
                    <label class="float-right">الاسم بالكامل</label>
                    <input type="text" name="name" class="form-control" required
                           placeholder="الاسم بالكامل">
                </div>
                <div class="form-group">
                    <label class="float-right">الهاتف للتواصل</label>
                    <input type="text" pattern="[0-9]*" name="phone" class="form-control " required
                           placeholder="الهاتف للتواصل">
                </div>
                <div class="form-group">
                    <label class="float-right">العنوان بالتفصيل</label>
                    <input type="text" name="address" class="form-control " required
                           placeholder="مثال: بني مزار - المنيا ">
                </div>
                <div class="form-group">
                    <label class="float-right">العمر</label>
                    <input type="text" name="age" class="form-control " required
                           placeholder="لابد ان  لايقل عن 18 سنه">
                </div>
                <div class="form-group">
                    <label class="float-right">نبذه عنك</label>
                     <textarea class="form-control" name="resume"  rows="10" placeholder="ملاحظات تساعد صاحب العمل  في اختيارك او التواصل معك "></textarea>
                </div>

                <div class="form-group">
                    <a href="{{url('/job')}}" class="btn btn-info ml-2">رجوع</a>
                    <input type="submit" class="btn btn-success " value="تقدم">
                </div>
            </form>

        </div>
    </section>





@endsection
