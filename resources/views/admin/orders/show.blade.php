@extends('admin.layouts.app')


@section('content')

@section('page_title')
Orders
@endsection()


<!-- Main content -->
<section class="content">


            <div class="card">
                <div class="card-header ">
                    <div class="float-left">
                        <h3 class="mb-0">Invoice #{{$record->id}}</h3>
                        Date: {{$record->created_at}}
                    </div>
                    <div class="float-right">
                        <a class="btn btn-sm btn-info float-right mr-1 d-print-none" href="{{url('admin/order')}}" data-abc="true">
                           back  <i class="fa fa-forward"></i></a>
                        <a class="btn btn-sm btn-secondary float-right mr-1 d-print-none" href="#" onclick="javascript:window.print();" data-abc="true">
                            <i class="fa fa-print"></i> Print</a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="mb-3">From:</h5>
                            <h3 class="text-dark mb-1">{{$record->resturant->name}}</h3>
                            <div>Email: {{$record->resturant->email}}</div>
                            <div>Phone: +2 {{$record->resturant->phone}}</div>
                        </div>
                        <div class="col-sm-6 ">
                            <h5 class="mb-3">To:</h5>
                            <h3 class="text-dark mb-1">{{$record->client->name}} </h3>
                            <div>Email: {{$record->client->email}}</div>
                            <div>Phone: +2 {{$record->client->phone}}</div>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th class="center">Qty</th>
                                <th class="right">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($record->products as $product)
                            <tr>
                                <td class="center">{{$loop->iteration}}</td>
                                <td class="left strong">{{$product->name}}</td>
                                <td class="left">{{$product->description}}</td>
                                <td class="center">{{$product->pivot->amount}}</td>
                                <td class="right">{{$product->pivot->price}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">
                        </div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Subtotal</strong>
                                    </td>
                                    <td class="right">${{$record->cost}}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">commission </strong>
                                    </td>
                                    <td class="right">${{$record->commission}}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Total</strong> </td>
                                    <td class="right">
                                        <strong class="text-dark">${{$record->total}}</strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <p class="mb-0">BBBootstrap.com, Sounth Block, New delhi, 110034</p>
                </div>

        </div>
</section>
<!-- /.content -->
@endsection
