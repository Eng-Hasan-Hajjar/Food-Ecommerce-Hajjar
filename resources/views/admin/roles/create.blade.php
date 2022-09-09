@extends('admin.layouts.app')

@inject('perm','Spatie\Permission\Models\Permission')

@section('content')

@section('page_title')
    Create Role
@endsection()


<!-- Main content -->
<section class="content">

    <div class="row justify-content-center">
        <div class="col-9 ">
            @include('admin.partials.error')
            <div class="card card-primary">
                <div class="card-header bg-info">
                    <h3 class="card-title">Create role</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{url('admin\role')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="titleForPost">name</label>
                            <input type="text" name="name" class="form-control" id="title" placeholder="Enter name for role">
                        </div>
                        <div class="form-group">
                            <label for="description">description </label>
                            <textarea name="description"  class="form-control" rows="10" ></textarea>
                        </div>

                        <div class="form-group">
                            <label for="checkbox">Permissions</label>
                            <div class="row">
                                <label class="col-md-3 ">
                                   <input id="checkall" type="checkbox" >   Select All
                                </label>
                            </div>
                            @foreach($perm::all()->groupBy('group_name') as $key => $permission)
                                <p class="alert alert-info">{{$key}} Control</p>
                            <div class="row">
                                @foreach($permission as $per)
                                    <div class="col-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="checkboxes" value="{{$per->id}}" name="permissions_list[]">
                                                {{$per->name}}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                            </div>
                            @endforeach
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
