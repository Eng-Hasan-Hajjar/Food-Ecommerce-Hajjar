
@extends('front.layouts.app')
@section('content')

<section class="back-body">
    <div class="shadow register-seler register add_offer text-center">
        <form class="container" method="POST" action="{{route('login')}}">
            @csrf
            <div class="form-group text-center">
                <span class="icon-user"><i class="fa fa-user"></i></span>
            </div>
            @include('front.partials.error')
            <div class="form-group">
                <input type="text" name="email" class="form-control"  value="{{ old('email') }}" required placeholder="الايميل">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control"  required placeholder="الباسورد">
            </div>
            <div class="form-group mt-4">
                <input class="btn btn-danger btn-block" type="submit" value="دخول">
            </div>
            <div class="overflow-hidden">
                <div class="float-right"><a class="" href="{{url('/register')}}">مستخدم جديد؟</a></div>
                <div class="float-left">
                </div>
            </div>
            <div class="form-group mt-4">
                <a class="btn btn-danger btn-block" href="{{url('/register')}}">انشاء حساب جديد</a>
            </div>
        </form>

    </div>
</section>

@endsection
