@extends('admin.layouts.app')

@inject('role','Spatie\Permission\Models\Role')

@section('content')

@section('page_title')
    Create User
@endsection()


<!-- Main content -->
<section class="content">

    <div class="row justify-content-center">
        <div class="col-9 ">
            @include('admin.partials.error')
            <div class="card card-primary">
                <div class="card-header bg-info">
                    <h3 class="card-title">Create User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{url('admin\user')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label >name</label>
                            <input type="text" name="name" class="form-control"  placeholder="Enter user name">
                        </div>
                        <div class="form-group">
                            <label for="titleForPost">Email</label>
                            <input type="email" name="email" class="form-control"  placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label >password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label >Confirm password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="confirm password">
                        </div>
                        <div class="form-group">
                            <label>Role </label>
{{--                            <select id="inputState" name="roles_list" class="form-control">--}}
{{--                                <option selected>Choose role</option>--}}
{{--                                @foreach($role::all() as $r)--}}
{{--                                    <option value="{{$r->id}}">{{$r->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
                            <select  id="example" name="roles_list[]" class="form-control"  multiple="multiple">
                                 @foreach($role::all() as $r)
                                 <option value="{{$r->id}}">{{$r->name}}</option>
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

@push('js')
    <script src="{{asset('js/BsMultiSelect.min.js')}}"></script>
    <script>
        $(function(){

            $("select").bsMultiSelect();

        });

        $("select").bsMultiSelect({
            selectedPanelDefMinHeight: 'calc(2.25rem + 2px)',
            selectedPanelLgMinHeight: 'calc(2.875rem + 2px)',
            selectedPanelSmMinHeight: 'calc(1.8125rem + 2px)',
            selectedPanelDisabledBackgroundColor: '#e9ecef',
            selectedPanelFocusBorderColor: '#80bdff',
            selectedPanelFocusBoxShadow: '0 0 0 0.2rem rgba(0, 123, 255, 0.25)',
            selectedPanelFocusValidBoxShadow: '0 0 0 0.2rem rgba(40, 167, 69, 0.25)',
            selectedPanelFocusInvalidBoxShadow: '0 0 0 0.2rem rgba(220, 53, 69, 0.25)',
            filterInputColor: '#495057',
            selectedItemContentDisabledOpacity: '.65',
            dropdDownLabelDisabledColor: '#6c757d',
            placeholder: 'Select role...'
        });
    </script>
@endpush
