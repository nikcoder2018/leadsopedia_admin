<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>Leadsopedia | Admin</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ auth()->user()->api_token }}">

    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset(env('APP_THEME', 'default') . '/images/logo-new-solo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">

    <!-- END: Vendor CSS-->
    @yield('vendors_css')
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') }}">

    @yield('external_css')

    @yield('stylesheets')
    <style>
        @media(min-width: 576px) {
            th.control {
                display: none !important;
            }

            td.control {
                display: none !important;
            }
        }

    </style>

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern light-layout  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="" data-layout="dark-layout">

    <div id="main-content-wrapper">
        @include('partials.header')

        @include('partials.menu')

        {{-- @include('partials.customizer') --}}

        @yield('content')

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        @include('partials.footer')

        @yield('modals')
    </div>


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}">
    </script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/extensions/polyfill.min.js') }}">
    </script>
    @yield('vendors_js')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/scripts/customizer.js') }}"></script>
    <!-- END: Theme JS-->

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    @yield('external_js')

    @yield('scripts')

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })

    </script>
</body>
<!-- END: Body-->

</html>
