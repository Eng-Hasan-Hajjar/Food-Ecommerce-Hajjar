@extends('admin.layouts.app')
@inject('role','Spatie\Permission\Models\Role')
@section('content')
@section('page_title')
    Edit User
@endsection()


<!-- Main content -->
<section class="content">

    <div class="row justify-content-center">
        <div class="col-9 ">
            @include('admin.partials.error')
            <div class="card card-primary">
                <div class="card-header bg-info">
                    <h3 class="card-title">Edit role</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{url('admin/user/'.$record->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label >name</label>
                            <input type="text" name="name" value="{{$record->name}}" class="form-control"  placeholder="Enter user name">
                        </div>
                        <div class="form-group">
                            <label for="titleForPost">Email</label>
                            <input type="email" name="email" value="{{$record->email}}" class="form-control"  placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label>Role </label>
                            <select  id="example" name="roles_list[]" class="form-control"  multiple="multiple">
                                @foreach($role::all() as $r)
                                    <option value="{{$r->id}}"
                                         @foreach($record->roles as $rRoles)
                                             @if($rRoles->id === $r->id)
                                                 selected
                                                 @endif
                                             @endforeach
                                    >{{$r->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>



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
