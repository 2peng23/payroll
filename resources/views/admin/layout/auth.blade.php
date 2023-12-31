<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">       
        {{-- <link rel="icon" href="{{ asset('admin_assets/favicon.ico') }}" type="image/x-icon" /> --}}
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/ionicons/dist/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/icon-kit/dist/css/iconkit.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/theme.min.css') }}">
        <script src="{{ asset('admin_assets/src/js/vendor/modernizr-2.8.3.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

        @yield('css')
    </head>
    <body>      
        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-6 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                        <div class="lavalite-bg" style="background-image: url('{{ asset('admin_assets/img/auth/blmc.png') }}')">
                            <div class="lavalite-overlay"></div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div> 
        <script src="{{ asset('admin_assets/js/jquery-3.3.1.min.js') }}"></script>
        {{-- <script>window.jQuery || document.write('<script src="{{ asset('admin_assets/src/js/vendor/jquery-3.3.1.min.js') }}"><\/script>')</script> --}}
        {{-- <script src="{{ asset('admin_assets/plugins/popper.js/dist/umd/popper.min.js') }}"></script> --}}
        <script src="{{ asset('admin_assets/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
        {{-- <script src="{{ asset('admin_assets/plugins/screenfull/dist/screenfull.js') }}"></script> --}}
        {{-- <script src="{{ asset('admin_assets/dist/js/theme.js') }}"></script> --}}
        
        @yield('js')
        @stack('js')

    </body>
</html>
