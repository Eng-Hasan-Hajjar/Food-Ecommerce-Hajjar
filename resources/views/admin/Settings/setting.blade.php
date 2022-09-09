@extends('admin.layouts.app')


@section('content')

@section('page_title')
    Setting of site
@endsection()


<!-- Main content -->
<section class="content">

    <div class="row justify-content-center">
        <div class="col-9 ">
            @include('admin.partials.error')
            <div class="card card-primary">

                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{url('admin/setting/'.$record->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>About app</label>
                            <textarea class="form-control" name="about_app">{{$record->about_app}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Commission</label>
                            <input type="text" value="{{$record->commission}}" name="commission" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>text1</label>
                            <textarea class="form-control" name="text_up">{{$record->text_up}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>text2</label>
                            <textarea class="form-control" name="text_down">{{$record->text_down}}</textarea>
                        </div>

                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-primary">
                            <span class="fa fa-1x fa-save"> save</span>
                        </button>
                    </div>
                </form>


                <!--  form end       -->
                {{--            @include('partials.form')--}}

            </div>
        </div>

    </div>
</section>
<!-- /.content -->
@endsection
