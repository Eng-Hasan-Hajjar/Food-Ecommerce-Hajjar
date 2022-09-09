<!-- jQuery -->
<script src="{{asset("adminlte/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- popper -->
<script src="{{asset('js/popper.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("adminlte/js/adminlte.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("adminlte/js/demo.js")}}"></script>
<script src="{{asset('app.js')}}"></script>

<!-- DataTables -->
<script src="{{url('adminlte')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('adminlte')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('adminlte')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('adminlte')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}" ></script>
@include('sweetalert::alert')
@stack('js')


</body>
</html>
