@extends('admin.layouts.app')
@inject('role','Spatie\Permission\Models\Role')

@section('content')

@section('page_title')
    Users
@endsection()


<!-- Main content -->
<section class="content">

    @include('admin.partials.error')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{url("admin/user/create")}}" class="btn btn-block btn-primary">
                                <span class="fa fa-1x fa-plus">Add user</span>
                            </a>
                        </h3>
                    </div>
                @if(count($records))
                    <!-- /.card-header -->
                    <div class="table-responsive ">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Edit</th>
                                <th>Delete</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->email}}</td>
                                <td>
                                    @if($record->roles)
                                    @foreach($record->roles as $role)
                                        <span class="btn-success btn-sm">{{$role->name}}</span>
                                        @endforeach
                                        @else
                                        No Role
                                        @endif
                                </td>
                                <td>
                                    <a href="{{url('admin/user/'.$record->id.'/edit')}}" class="btn btn-success float-left mr-2">
                                        <span class="fa fa-info-circle fa-1x"> Edit</span>
                                    </a>
                                </td>
                                <td>
                                    <form action={{url('admin/user/'.$record->id)}} method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger float-left">Delete</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <div class="d-flex justify-content-center">
                    {{$records->links()}}
                </div>

                <!-- /.card -->
            </div>

        </div>
        @else
            <div class="row">
                <div class="col-11 m-3 px-3">
                    <div class="alert alert-info">
                        There's no users
                    </div>
                </div>
            </div>
        @endif





</section>
<!-- /.content -->
@endsection

