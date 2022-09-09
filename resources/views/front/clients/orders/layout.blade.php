

@extends('front.layouts.app')
@section('head')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')

    <!-- scond nav -->
    <nav class="nav-scon">
        <div class="container">
            <div class="row text-center">
                <div class="col col-6">
                    <a class="{{ Request::is('order/new') ? 'activ' : '' }}" href="{{route('newOrder')}}">الطلبات</a>
                </div>
{{--                <div class="col col-6">--}}
{{--                    <a class="{{ Request::is('order/old') ? 'activ' : '' }}" href="{{route('oldOrder')}}">طلبات سابقة</a>--}}
{{--                </div>--}}
            </div>
        </div>
    </nav>
    @yield('nav')

@endsection
