<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','index')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{asset("Dashboard/plugins/ionicons/font/fonts.css")}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("Dashboard/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset("Dashboard/plugins/ionicons/2.0.1/css/ionicons.min.css")}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset("Dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset("Dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset("Dashboard/plugins/jqvmap/jqvmap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("Dashboard/dist/css/adminlte.min.css")}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset("Dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset("Dashboard/plugins/daterangepicker/daterangepicker.css")}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset("Dashboard/plugins/summernote/summernote-bs4.min.css")}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset("Dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("Dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("Dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css")}}">
    @yield('css')
    @toastr_css
</head>
