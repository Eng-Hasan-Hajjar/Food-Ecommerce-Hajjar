
@extends('front.layouts.app')
@section('content')

    @inject('cities',App\Models\City)
    @inject('category',App\Models\Category)
    <!-- start section evaluation -->
    <section class="back-body">

        <div class="shadow register-seler register add_offer text-center">
            <form class="container" method="POST" action="{{route('register')}}"enctype="multipart/form-data">
                @csrf
                <div class="form-group text-center">
                    <span class="icon-user"><i class="fa fa-user"></i></span>
                </div>
                <div class="form-group">
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="اسم المستخدم">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group ">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="البريد الالكتروني">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="الرقم السري ">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="تاكيد الرقم السري">
                </div>
                <div class="form-group">
                    <input type="number" name="phone" class="form-control  @error('phone') is-invalid @enderror" value="{{old('phone')}}" required placeholder="الجوال">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
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
                    <select disabled class="form-control @error('district_id') is-invalid @enderror" id="district"   name="district_id">
                    </select>
                    @error('district_id')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
{{--                <div class="text-right">--}}
{{--                    <h3 class="d-inline-block">صورة المستخدم</h3>--}}
{{--                </div>--}}
{{--                <div class="img-input">--}}
{{--                    <div class="img">--}}
{{--                        <img src="{{asset('front/images/default-image.jpg')}}" alt="">--}}
{{--                        <input type="file" name="image" accept="image/*" id="product_image">--}}
{{--                    </div>--}}
{{--                </div>--}}
                <p class="text-right mb-5">بانشاء حساب انت توافق علي <span style="color:rgb(187, 14, 14)">شروط الاستخدام</span> الخاصة بسفرة</p>
                <div class="form-group mt-4">
                    <button>تسجيل</button>
                </div>
            </form>

        </div>
    </section>
@endsection
