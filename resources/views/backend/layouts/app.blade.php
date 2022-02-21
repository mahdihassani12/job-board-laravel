<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>صفحه شروع | کنترل پنل</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/css/rtl.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/css/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/css/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/css/AdminLTE.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/css/skin-blue.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/custom.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/css/select2.min.css') }}">
  @yield('style')
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- header -->
    @include('backend.partials.header')

    <!-- sidebar -->
    @include('backend.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">

      @include('backend.messages.flash_messages')

      @yield('main_content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ asset('public/backend/js/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('public/backend/js/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/backend/js/adminlte.min.js') }}"></script>
<script src="{{ asset('public/backend/js/select2.min.js') }}"></script>
<script src="{{ asset('public/backend/custom.js') }}"></script>
@yield('script')
</body>
</html>