@extends('admin.layouts.app')

@section('content')
@inject('city','App\Models\City')
@section('page_title')
    Edit district
@endsection()


<!-- Main content -->
<section class="content">

    <div class="row justify-content-center">
        <div class="col-9 ">
            @include('admin.partials.error')
            <div class="card card-primary">
                <div class="card-header bg-info">
                    <h3 class="card-title">Edit destrict</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{url('admin/district/'.$record->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="titleForPost">name</label>
                            <input type="text" value="{{$record->name}}" name="name" class="form-control" id="name" placeholder="Enter name for district">
                        </div>
                        <div class="form-group">
                            <label>Cities</label>
                            <select id="inputState" name="city_id" class="form-control">
                                @foreach($city::all() as $c)
                                    <option @if($c->id == $record->city_id) selected @endif value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
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
