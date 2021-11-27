@if (!session()->has('email'))
    <script>
        window.location = "{{ route('login.view') }}";
    </script>
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title') </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ URL::asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet"
        href="{{ URL::asset('admin/plugins/datetimepicker/build/jquery.datetimepicker.min.css') }}">


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/adminlte.min.css') }}">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ URL::asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">


    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ URL::asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- dropzonejs -->

    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/dropzone/min/dropzone.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    @yield('extra-css')
</head>

<body class="hold-transition layout-navbar-fixed layout-fixed sidebar-mini">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble"
                src="{{ URL::asset('admin/dist/img') }}/@yield('preloader-image-name', 'AdminLTELogo.png')"
                alt="AdminLTELogo" height="60" width="60">
            {{-- <br>
            @yield('preloader-message', 'Please Wait...') --}}
        </div>


        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <i class="fas fa-sign-out-alt"  data-title="Good Bye!"  href="{{ route('logout.view') }}" id="logOut"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        @php
            
        @endphp

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ request()->getHost() }}" class="brand-link">
                <span class="brand-text font-weight-light"> {{ request()->getHost() }} </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ URL::asset('admin/dist/img/user2-160x160.jpg') }}"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ session()->get('name') }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link active">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('timeline.view') }}" class="nav-link ">
                                <i class="nav-icon fas fa-clock"></i>
                                <p>
                                    Notice Board
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.view') }}" class="nav-link ">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Admin Management
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('company.view') }}" class="nav-link ">
                                <i class="nav-icon fas fa-building"></i>
                                <p>
                                    Company Management
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.view') }}" class="nav-link ">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    User Management
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('extra.view') }}" class="nav-link ">
                                <i class="nav-icon fas fa-network-wired"></i>
                                <p>
                                    Extra Management
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-project-diagram"></i>
                                <p>
                                    Project Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('project.companywise.view') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Companywise</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('project.view') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Projectwise</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('event.view') }}" class="nav-link ">
                                <i class="nav-icon fas fa-handshake"></i>
                                <p>
                                    Meetings and Events
                                </p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-money-bill-alt"></i>
                                <p>
                                    Payment Management
                                </p>
                            </a>
                        </li> --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                        <div class="col-sm-6">
                            <h1 class="m-0">
                                @yield('page-name')
                            </h1>
                        </div>

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <div class="content">
                <div class="container-fluid">
                    @yield('main-content')
                </div>
            </div>

        </div>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                @yield('sidebar-content')
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                version 0.1.2
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; {{ request()->getHost() }}</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ URL::asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- jQuery UI -->

    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ URL::asset('admin/dist/js/adminlte.min.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ URL::asset('admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ URL::asset('admin/plugins/datetimepicker/build/jquery.datetimepicker.full.js') }}"></script>

    <script src="{{ URL::asset('admin/plugins/moment/moment.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ URL::asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <script src="{{ URL::asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script>
        var url = window.location;
        $('ul.nav-sidebar a').removeClass('active').parent().siblings().removeClass('menu-open');
        $('ul.nav-sidebar a').filter(function() {
            return this.href == url;
        }).addClass('active').closest(".has-treeview").addClass('menu-open').find("> a").addClass('active');

        function showPreloader() {
            $('.preloader').css('height', '100%');
            $('.preloader').children().show();
        }

        function hidePreloader() {
            $('.preloader').css('height', 0);
            $('.preloader').children().hide();
        }

        function getExtraTableData(name, idToView) {
            $.get("extra/" + name, function(extra) {
                $('#' + idToView).val(extra.value);
            });
        }

        $('#logOut').confirm({
            content: "Are you sure you want to logout?",
        });
        $('#logOut').confirm({
            buttons: {
                hey: function() {
                    window.location = this.$target.attr('href');
                }
            }
        });
    </script>
    @yield('extra-js')
</body>

</html>
