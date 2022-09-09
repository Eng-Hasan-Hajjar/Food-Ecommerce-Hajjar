
@if($errors->any())
    <div class="alert alert-danger text-right font-weight-bold ">
        <span  type="button" class="close" data-dismiss="alert">×</span>
        <ul>
            @foreach($errors->all() as $error)

                <li>{{$error}}</li>

                @endforeach
        </ul>
    </div>
    @endif

@if(session('status'))

    <div class="alert alert-success text-right font-weight-bold ">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{session('status')}}
    </div>
@endif
@if(session('error'))

    <div class="alert alert-danger  text-right font-weight-bold">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{session('error')}}
    </div>
@endif


