@include('admin.layouts.header')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('admin-content')
        <!-- /.content-wrapper -->

        @include('admin.layouts.footer')
        @include('admin.layouts.scripts')
