<footer>
    <div class="container">
        <div class="row">
            <div class="col col-sm-6 col-12  div-text text-right ">
                <h2 class="h1  mb-4"><img style="width: 10%;" src="{{asset('front/images/edit-min.png')}}"></span> من نحن </h2>

                <p>{{$settings->about_app}}  </p>
                <p>
                    <span class="p-2"><i class="fab fa-facebook"></i></span>
                    <span class="p-2"><i class="fab fa-twitter"></i></span>
                    <span class="p-2"><i class="fab fa-instagram"></i></span>

                </p>
            </div>
            <div class="col col-sm-6 col-12 text-left  "><img class="img" src="{{asset('front/images/sofra logo-1@2x.png')}}"></div>
        </div>
    </div>
</footer>
<!-- start nav  -->
<script src="{{asset('front/librarys/jquery.3.1.1.js')}}" ></script>
<script src="{{asset('front/librarys/popper.min.js')}}"></script>
<script src="{{asset('front/librarys/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front/librarys/slick/slick.min.js')}}"></script>
{{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>--}}
<script src="{{asset('front/js/script.js')}}" ></script>
<script src="{{asset('front/js/appkero.js')}}" ></script>
<script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}" ></script>
@include('sweetalert::alert')

<!-- DataTables -->
<script src="{{url('adminlte')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('adminlte')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('adminlte')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('adminlte')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    @stack('js')
</body>
</html>
