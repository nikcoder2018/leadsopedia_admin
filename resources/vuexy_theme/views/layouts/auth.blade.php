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
                                    <svg width="44" height="45" viewBox="0 0 603 639" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="603" height="639" rx="30" fill="#4464F6"/>
                                        <path d="M603 29C596.311 258.545 224.274 466.278 20.5061 549.786C18.8137 550.479 17.9675 550.826 17.3247 551.126C7.07057 555.906 0.568157 565.598 0.0335166 576.899C0 577.607 0 578.446 0 580.125V606.6C0 608.828 0 609.943 0.0591981 610.884C1.00826 625.969 13.0314 637.992 28.1163 638.941C29.0572 639 30.1715 639 32.4 639H570.6C572.829 639 573.943 639 574.884 638.941C589.969 637.992 601.992 625.969 602.941 610.884C603 609.943 603 608.828 603 606.6V29Z" fill="#1C38B5"/>
                                        <path d="M603 29C596.311 258.545 224.274 466.278 20.5061 549.786C18.8137 550.479 17.9675 550.826 17.3247 551.126C7.07057 555.906 0.568157 565.598 0.0335166 576.899C0 577.607 0 578.446 0 580.125V606.6C0 608.828 0 609.943 0.0591981 610.884C1.00826 625.969 13.0314 637.992 28.1163 638.941C29.0572 639 30.1715 639 32.4 639H570.6C572.829 639 573.943 639 574.884 638.941C589.969 637.992 601.992 625.969 602.941 610.884C603 609.943 603 608.828 603 606.6V29Z" fill="url(#paint0_linear)"/>
                                        <path d="M90 89C90 83.4772 94.4772 79 100 79H176V560H100C94.4772 560 90 555.523 90 550V89Z" fill="white" fill-opacity="0.85"/>
                                        <path d="M176 560V474H433V550C433 555.523 428.523 560 423 560H176Z" fill="white" fill-opacity="0.85"/>
                                        <circle cx="302" cy="334" r="50" fill="#FF020C" fill-opacity="0.72"/>
                                        <circle cx="302" cy="334" r="50" fill="url(#paint1_linear)" fill-opacity="0.8"/>
                                        <defs>
                                        <linearGradient id="paint0_linear" x1="301.5" y1="29" x2="301.5" y2="639" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#4464F6"/>
                                        <stop offset="1" stop-color="#1C38B5"/>
                                        </linearGradient>
                                        <linearGradient id="paint1_linear" x1="302" y1="284" x2="302" y2="384" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#B51C1C"/>
                                        <stop offset="0.522074" stop-color="#DA0D0D"/>
                                        <stop offset="1" stop-color="#FB5A00"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                    <h2 class="brand-text text-white ml-1 mt-1">Leadsopedia</h2>
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

