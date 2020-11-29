<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login | Leadsopedia Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />

        <!-- Bootstrap Css -->
        <link href="{{asset(env('APP_THEME').'/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset(env('APP_THEME').'/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset(env('APP_THEME').'/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-body-bg">
        <div class="home-btn d-none d-sm-block">
            <a href="{{route('home')}}"><i class="mdi mdi-home-variant h2 text-white"></i></a>
        </div>
        <div>
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-5">
                        @yield('content')
                    </div>
                    <div class="col-lg-7">
                        <div class="authentication-bg">
                            <div class="bg-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- JAVASCRIPT -->
        <script src="{{asset(env('APP_THEME').'/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset(env('APP_THEME').'/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset(env('APP_THEME').'/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset(env('APP_THEME').'/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset(env('APP_THEME').'/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{asset(env('APP_THEME').'/js/app.js')}}"></script>

    </body>
</html>

