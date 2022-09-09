
@extends('front.layouts.app')
@section('content')

    @inject('cities',App\Models\City)
    @inject('category',App\Models\Category)
    <!-- start section evaluation -->
    <section class="back-body">

        <div class="shadow register-seler register add_offer text-center">
            <form class="container" method="POST" action="{{route('R.register')}}"enctype="multipart/form-data">
                @csrf
                <div class="form-group text-center">
                    <span class="icon-user"><i class="fa fa-user"></i></span>
                </div>
                @include('front.partials.error')
                <div class="form-group">
                    <input type="text" name="name" class="form-control" required placeholder="اسم المطعم">
                </div>
                <div class="form-group ">
                    <input type="email" name="email" class="form-control" required placeholder="البريد الالكتروني">
                </div>
                <div class="form-group">
                    <input type="number" name="phone" class="form-control" required placeholder="الجوال">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" required placeholder="الرقم السري ">
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="تاكيد الرقم السري">
                </div>
                <div class="form-group">
                    <input type="number" name="delivery_charge" class="form-control" min="0" required placeholder="رسوم التوصيل">
                </div>
                <div class="form-group">
                    <select class="form-control"  id="city">
                        <option selected disabled> المدينه </option>
                       @foreach($cities::all() as $city)
                           <option value="{{$city->id}}">{{$city->name}}</option>
                           @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select disabled class="form-control" id="district" name="district_id">
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" name="minimum_order" class="form-control" required placeholder="اقل سعر للطلب">
                </div>
                <div class="form-group">
                    <select  id="example" name="category_list[]" class="form-control" multiple>
                        <option selected disabled>االتصنيفات</option>
                        @foreach($category::all() as $r)
                            <option value="{{$r->id}}">{{$r->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group d-flex">
                    <div class="custom-switch justify-content-end">
                        <input type="hidden" name="state" value="0">
                        <input type="checkbox" name="state" value="1" checked class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label"  for="customSwitch1">الحاله</label>
                    </div>
                </div>
                <div class="form-group d-flex">
                    <div class="custom-switch justify-content-end">
                        <input type="hidden" name="job" value="0">
                        <input type="checkbox" name="job" value="0"  class="custom-control-input" id="job">
                        <label class="custom-control-label"  for="job">قبول موظفين</label>
                    </div>
                </div>
                <div class="d-flex">
                    <h6 class="justify-content-end" style="color: #0c525d">بيانات التواصل</h6>
                </div>

                <div class="form-group">
                    <input type="number" class="form-control" name="contact_phone" required placeholder="رقم الجوال  للتواصل">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="whats"  placeholder="رقم الواتس">
                </div>
                <div class="text-right">
                    <h3 class="d-inline-block">صورة المطعم</h3>
                </div>
                <div class="img-input">
                    <div class="img">
                        <img src="{{asset('front/images/default-image.jpg')}}" alt="">
                        <input type="file" name="image" accept="image/*" id="product_image">
                    </div>
                </div>
                <p class="text-right mb-5">بانشاء حساب انت توافق علي <span style="color:rgb(187, 14, 14)">شروط الاستخدام</span> الخاصة بسفرة</p>
                <div class="form-group mt-4">
                    <button>دخول</button>
                </div>
            </form>

        </div>
    </section>
@endsection
