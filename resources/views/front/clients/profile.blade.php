@extends('front.layouts.app')
@section('content')

    @inject('district',App\Models\District)
    @inject('cities',App\Models\City)
    @inject('category',App\Models\Category)
    <!-- start section evaluation -->
    <section class="back-body">

        <div class="shadow register-seler register add_offer text-center">
            <form class="container" method="POST" action="{{url('update-profile')}}" enctype="multipart/form-data">
                <div class="">
                    <h4>تعديل البيانات </h4>
                </div>
                @csrf
                @include('front.partials.error')
                <div class="form-group">
                    <label class="float-right">اسم المستخدم</label>
                    <input type="text" name="name" class="form-control" value="{{$record->name}}" required
                           placeholder="اسم المستخدم">
                </div>
                <div class="form-group">
                    <label class="float-right">الجوال</label>
                    <input type="number" name="phone" class="form-control " value="{{$record->phone}}" required
                           placeholder="الجوال">
                </div>
                <div class="form-group">
                    <select class="form-control" id="city">
                        <label class="float-right">المدينه</label>
                        <option selected disabled> المدينه</option>
                        @foreach($cities::all() as $city)
                            <option value="{{$city->id}}"
                                    @if($city->id === $record->district->city->id) selected @endif>{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="float-right">الحي</label>
                    <select class="form-control" id="district" name="district_id">
                        @foreach($district::where('city_id',$record->district->city->id)->with('city')->get() as $dis)
                            <option value="{{$dis->id}}"
                                    @if($dis->id == $record->district->id)
                                    selected
                                @endif
                            >{{$dis->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="text-right">
                        <h3 class="d-inline-block">صورة المستخدم</h3>
                    </div>
                    <div class="img-input">
                        <div class="img">
                            <img src="{{asset('images/profile/'.$record->image)}}" alt="">
                            <input type="file" name="image" accept="image/*" id="product_image">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <a href="{{url('/')}}" class="btn btn-info ml-2">رجوع للرئسية</a>
                    <input type="submit" class="btn btn-success " value="حفظ التعديلات">
                </div>
            </form>

        </div>
    </section>
@endsection
