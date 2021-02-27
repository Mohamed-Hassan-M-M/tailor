<!DOCTYPE html>
<html lang="en">
@include("dashboard.includes.head")
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    @include("dashboard.includes.header")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include("dashboard.includes.sidebar")

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->
    @include("dashboard.includes.footer")

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('dashboard.includes.script')
@yield('script')
</body>
@toastr_js
@toastr_render
</html>
