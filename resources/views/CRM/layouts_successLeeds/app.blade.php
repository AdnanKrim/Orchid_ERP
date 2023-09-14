<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('backend/dist/js/toastr/toastr.min.css')}} ">
    <!-- Icofont Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
          integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-4.min.css')}} ">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style media="screen">
        .footer{
            font-family: arial, sans-serif;
            width:100%;
            margin:auto;
            text-align: center;
            line-height: .6rem;
            font-size: 22px;
            font-weight: 500;
        }
        .firstImage{
            display:inline-block;
            width:35%;
            margin-left: 4rem;
        }
        .first{
            font-style: italic;
            font-size: 4rem;
            color:#008000;
            font-weight: 600;
            margin:2px 1px;
            font-weight: 900;
        }
        .header{
            width:100%;
            display:flex;
            align-items: center;
            margin:auto;
            justify-content: space-between;
        }
        .all{
            width:100%;
        }
        .second{
            font-family: Arial, Helvetica, sans-serif;
        }
        .h2{}
        .secondItem{
            margin:auto;
            width:100%;
        }
        .thirdPortion{
            width:80%;
            display: flex;
            justify-content:space-between;
            margin:auto;
            font-family: Arial, Helvetica, sans-serif;
        }
        .fourthPortion{
            font-family: Arial, Helvetica, sans-serif;
            margin:auto;
            width:95%;
        }
        .line{
            line-height: 12px;
        }
        .table2 {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 90%;
            margin:auto;
            border:2px solid #000000 !important;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {

        }
        .table-secondary{
            background-color: 	#808080;
        }
        .bottom{
            font-family: arial, sans-serif;
            width: 95%;
            margin:auto;
        }
        .bottomCenter{
            width:95%;
            margin:auto;
        }
        .orchid{
            display:flex;
            justify-content: space-between;
        }
        .buttontop{
            width:100%;
            display:flex;
            justify-content: flex-end;
        }
        .button2 {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 35px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .imgWrap {
            display: flex;
            justify-content: center;
        }
        .imgcontain {
            position: relative;
            width: max-content
        }
        .imgcontain img {
            display: block;
        }
        .imgcontain .fa-trash {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .addStyle{
            margin-left:11px;
        }
        .swal2-popup.swal2-toast .swal2-title{
            margin-top:7px;
            font-size:1rem;
        }
        .wrapper .content-wrapper{

        calc(100vh - calc(3.5rem + 1px) - calc(3.5rem + 1px)) !important;
            margin-top:3.4rem !important;
        }
        span#dateTime_wrapper{
            width:100% !important;
        }

    </style>
    <!-- New font start-->
    {{--    <link rel="stylesheet" href="{{ asset('backend/dist/css/alt/bootstrap.min.css') }}" />--}}
    {{--    <link rel="stylesheet" href="{{ asset('backend/dist/css/alt/bootstrap-select.min.css') }}" />--}}
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">--}}
    <!-- New font end-->
    <link href="http://cdn.syncfusion.com/20.3.0.47/js/web/flat-azure/ej.web.all.min.css" rel="stylesheet" />
    <!--Scripts-->
    <script src="{{asset('js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('js/ej.web.all.min.js')}}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper" id="app">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
             height="60" width="60">
    </div>
    <!-- Navbar -->
    @include('CRM.layouts_successLeeds.navbar')
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    @include('CRM.layouts_successLeeds.sidebar')

    @yield('content')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('backend/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('backend/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
{{--<script src="{{asset('backend/dist/js/pages/dashboard2.js')}}"></script>--}}
{{--<script src="{{asset('backend/dist/js/toastr/toastr.min.js')}} "></script>--}}
<!-- Alert -->
{{--<script src="{{asset('backend/dist/js/custom.js')}}"></script>--}}
<script src="{{asset('backend/dist/js/sweetalert2.min.js')}}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<!-- change -->
<script type="text/javascript">
    $(function () {
        $('#dateTime').ejDateTimePicker({
            interval: 05,
            width:'100%',
        });
    });
</script>
<script src="http://cdn.syncfusion.com/js/assets/external/jquery-1.10.2.min.js"> </script>
<script src="http://cdn.syncfusion.com/20.3.0.47/js/web/ej.web.all.min.js"></script>
</body>
{{--<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}
<!-- Option 2: Separate Popper and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
{{--<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.min.js')}}"></script>--}}
<script src="{{asset('backend/dist/js/bootstrap-select.min.js')}}"></script>

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
</html>
