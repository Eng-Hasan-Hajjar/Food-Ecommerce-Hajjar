

@extends('front.layouts.app')
@section('head')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')

<nav class="nav-scon responsev">
    <div class="container">
        <div class="row text-center">
            <div class="col col-sm-4 order-sm-1 order-3 col-12  ">
                <a class="{{ Request::is('resturant/order') ? 'activ' : '' }}" href="{{route('new')}}">طلبات جديدة</a>
            </div>
            <div class="col col-sm-4 order-sm-2 ">
                <a class="{{ Request::is('resturant/order/current') ? 'activ' : '' }}" href="{{route('current')}}">طلبات حالية</a>
            </div>
            <div class="col col-sm-4 order-sm-3 ">
                <a class="{{ Request::is('resturant/old') ? 'activ' : '' }}" href="{{route('old')}}">طلبات سابقة</a>
            </div>
        </div>
    </div>
</nav>
@yield('nav')

@endsection
