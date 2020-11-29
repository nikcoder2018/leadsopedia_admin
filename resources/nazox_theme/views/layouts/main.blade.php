<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Leadsopedia | Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />

        @yield('plugins_css')

        <!-- Bootstrap Css -->
        <link href="{{asset(env('APP_THEME').'/css/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset(env('APP_THEME').'/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset(env('APP_THEME').'/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" />

        @yield('stylesheets')
    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('includes.navbar')

            
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    @include('includes.sidebar')
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    @yield('content')
                </div>
                <!-- End Page-content -->

                @include('includes.footer')
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        @include('includes.rightbar')

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{asset(env('APP_THEME').'/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset(env('APP_THEME').'/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset(env('APP_THEME').'/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset(env('APP_THEME').'/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset(env('APP_THEME').'/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset(env('APP_THEME').'/libs/moment/moment.js')}}"></script>
        @yield('plugins_js')
        
        <script src="{{asset(env('APP_THEME').'/js/app.js')}}"></script>

        @yield('scripts')
    </body>
</html>
