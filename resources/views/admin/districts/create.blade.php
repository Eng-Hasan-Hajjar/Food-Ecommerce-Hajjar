@extends('admin.layouts.app')


@section('content')
@inject('city','App\Models\City')
@section('page_title')
    Create District
@endsection()


<!-- Main content -->
<section class="content">

    <div class="row justify-content-center">
        <div class="col-9 ">
            @include('admin.partials.error')
            <div class="card card-primary">
                <div class="card-header bg-info">
                    <h3 class="card-title">Create district</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{url('admin\district')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="titleForPost">name</label>
                            <input type="text" name="name" class="form-control" id="title" placeholder="Enter name for district">
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <select id="inputState" name="city_id" class="form-control">
                                <option selected>Choose city</option>
                                @foreach($city::all() as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>

                <!--  form end       -->
                {{--                @include('partials.form')--}}

            </div>
        </div>

    </div>









</section>
<!-- /.content -->
@endsection
