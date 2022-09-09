@extends('front.layouts.app')
@section('content')


    <section class="content my-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header py-4">
                            <h3 class="text-center pb-2">ابحث عن مطعم</h3>
                            <form id="search-job" class="form-row justify-content-center">
                                <input type="hidden" id="token" value="{{csrf_token()}}">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col col-sm-4">
                                            <select id="cityId" name="city" class="form-control">
                                                <option selected disabled value="0"> اختر المدينة</option>
                                                @foreach($city as $c)
                                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <input id="resturantId" type="text" name="resturant" class="form-control"
                                                   placeholder="مثال: كنتاكي">
                                        </div>
                                        <div class="col col-2">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-right ">
                            @if(count($resturants))
                                <div class="row " id="resturant">
                                    @foreach($resturants as $resturant)
                                        <div class="col-4">
                                            <div class="card">
                                                <img src="{{url('images/profile/'.$resturant->image)}}"
                                                     class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title text-danger">
                                                        <a href="{{url('resturants/'.$resturant->id)}}"
                                                           class="text-danger"
                                                           style="text-decoration: none">{{$resturant->name}}</a>
                                                        <p class="float-left">
                                                            @for($i=1;$i<=5;$i++)
                                                                <span><i class="@if($resturant->review >= $i) fas @else far @endif fa-star"></i></span>
                                                            @endfor
                                                        </p>
                                                        </p>
                                                    </h5>
                                                    <p class="card-text text-info"><i class="fas fa-map-marker-alt"></i>   {{$resturant->district->city->name}} - {{$resturant->district->name}}</p>
                                                    <a href="{{url('apply/'.$resturant->id)}}" class="btn btn-primary">تقدم علي الوظيفة</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-muted text-center">
                                    <span>لا يوجد مطاعم تريد عمال حتي الان</span>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer float-right">
                            {{$resturants->Links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





@endsection
