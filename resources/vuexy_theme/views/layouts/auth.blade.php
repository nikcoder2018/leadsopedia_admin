<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login | Leadsopedia Admin</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/themes/bordered-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/pages/page-auth.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page" data-layout="dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v1 px-2">
                    <div class="auth-inner py-2">
                        <!-- Login v1 -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="javascript:void(0);" class="brand-logo">
                                    <span class="brand-logo">
                                        <img src="{{asset(env('APP_THEME','default').'/images/logo-default.png')}}" width="230px">
                                    </span>
                                </a>

                                @yield('content')

                            </div>
                        </div>
                        <!-- /Login v1 -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset(env('APP_THEME','default').'/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->
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

