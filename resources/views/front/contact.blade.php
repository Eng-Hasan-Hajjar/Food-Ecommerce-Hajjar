
@extends('front.layouts.app')
@section('content')

    <div class="row mt-3">
            <div class="col-10 mr-2">
                @include('front.partials.error')
            </div>
        </div>
    <section class="shadow connect-us add_offer text-center">
        <form class="container" method="POST" action="{{url('send-message')}}">
            @csrf
            <div class="form-group">
                <h2 > تواصل معنا</h2>
            </div>
            <div class="form-group">
                <input type="text" name="full_name" class="form-control"  required placeholder=" الاسم كاملا">
            </div>
            <div class="form-group ">
                <input type="email" name="email" class="form-control"  required placeholder="البريد الاكتروني">
            </div>
            <div class="form-group">
                <input type="number" name="phone" class="form-control"  required placeholder="الجوال">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="message" required placeholder=" ما هي رسالتك ؟" rows="5"></textarea>
            </div>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="inlineRadio2">شكوي</label>
                    <input class="form-check-input" type="radio" name="type" value="complaint">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="inlineRadio2">اقتراح</label>
                    <input class="form-check-input" type="radio" name="type" value="suggestion">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="inlineRadio2">استعلام</label>
                    <input class="form-check-input" type="radio" name="type" value="inquiry">
                </div>
            </div>
            <div class="form-group">
                <button>ارسال</button>
            </div>
        </form>

    </section>



@endsection
