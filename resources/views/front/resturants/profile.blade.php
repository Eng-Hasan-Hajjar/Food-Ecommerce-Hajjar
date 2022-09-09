@extends('front.layouts.app')
@section('content')

    @inject('cities',App\Models\City)
    @inject('district',App\Models\District)
    @inject('category',App\Models\Category)
    <!-- start section evaluation -->
    <section class="back-body">

        <div class="shadow register-seler register add_offer text-center">
            <form class="container" method="POST" action="{{url('resturant/update')}}" enctype="multipart/form-data">
                <div class="">
                    <h4>تعديل البيانات </h4>
                </div>
                @csrf
                @include('front.partials.error')
                <div class="form-group">
                    <label class="float-right">اسم المطعم</label>
                    <input type="text" name="name" value="{{$record->name}}" class="form-control"
                           placeholder="اسم المطعم">
                </div>
                <div class="form-group">
                    <label class="float-right">الجوال</label>
                    <input type="number" name="phone" value="{{$record->phone}}" class="form-control" required
                           placeholder="الجوال">
                </div>
                <div class="form-group">
                    <label class="float-right">رسوم التوصيل</label>
                    <input type="number" name="delivery_charge" value="{{$record->delivery_charge}}"
                           class="form-control" min="0" required placeholder="رسوم التوصيل">
                </div>
                <div class="form-group">
                    <select class="form-control" id="city">
                        <label class="float-right">المدينه</label>
                        <option selected disabled> المدينه</option>
                        @foreach($cities::all() as $city)
                            <option value="{{$city->id}}" @if($city->id === $record->district->city->id) selected @endif>{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="float-right">الحي</label>
                    <select  class="form-control" id="district" name="district_id">
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
                    <label class="float-right">اقل سعر للطلب</label>
                    <input type="number" name="minimum_order" value="{{$record->minimum_order}}" class="form-control" required placeholder="اقل سعر للطلب">
                </div>
                <div class="form-group">
                    <select id="example" name="category_list[]" class="form-control category-list" multiple>
                        <option  disabled>االتصنيفات</option>
                        @foreach($category::all() as $r)
                            <option value="{{$r->id}}"
                              @foreach($record->categories as $cat)
                                  @if($cat->id == $r->id)
                                      selected
                                      @endif
                                  @endforeach
                            >{{$r->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group d-flex">
                    <div class="custom-switch justify-content-end">
                        <input type="hidden" name="state" value="0">
                        <input type="checkbox" name="state" value="{{$record->state}}" @if($record->state == 1) checked @endif class="custom-control-input"
                               id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">الحاله</label>
                    </div>
                </div>
                <div class="form-group d-flex">
                    <div class="custom-switch justify-content-end">
                        <input type="hidden" name="job" value="0">
                        <input type="checkbox" name="job" value="{{$record->job}}" @if($record->job == 1) checked @endif class="custom-control-input" id="job">
                        <label class="custom-control-label"  for="job">قبول موظفين</label>
                    </div>
                </div>
                <div class="d-flex">
                    <h6 class="justify-content-end" style="color: #0c525d">بيانات التواصل</h6>
                </div>
                <div class="form-group">
                    <label class="float-right">رقم الجوال للتواصل</label>
                    <input type="number" class="form-control" name="contact_phone" required
                           placeholder="رقم الجوال  للتواصل" value="{{$record->contact_phone}}">
                </div>
                <div class="form-group">
                    <label class="float-right text-mu">رقم الواتس</label>
                    <input type="text" class="form-control" name="whats" placeholder="رقم الواتس"value="{{$record->whats}}" >
                </div>
               <div class="form-group">
                   <div class="text-right">
                       <h3 class="d-inline-block">صورة المطعم</h3>
                   </div>
                   <div class="img-input">
                       <div class="img">
                           <img src="{{asset('images/profile/'.$record->image)}}" alt="">
                           <input type="file" name="image" accept="image/*" id="product_image">
                       </div>
                   </div>
               </div>
                <div class="form-group">
                    <a href="{{url('resturant')}}" class="btn btn-info ml-2">رجوع</a>
                    <input type="submit" class="btn btn-success " value="حفظ التعديلات">
                </div>
            </form>

        </div>
    </section>
@endsection


