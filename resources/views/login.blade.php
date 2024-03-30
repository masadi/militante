<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Metra-lead, web application Lead dashboard information. Own by Metra">
    <meta name="keywords" content="lead, sales funnel, dashboard, web app">
    <meta name="author" content="TelkomMetra">
    <title>Login Page - Web Application Lead Dashboard Information</title>
    <link rel="apple-touch-icon" href="{{('app-assets/login/images/ico/favicon/apple-icon-120x120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{('app-assets/login/images/ico/favicon/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/vendors/css/extensions/sweetalert2.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/css/pages/authentication.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/login/css/style1.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static   menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content m-0">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover" style="background-image: url(app-assets/img/background.jpg);background-repeat: no-repeat;
  background-size: 100% 100%;">
                    <div class="auth-inner row m-0">
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <center><img src="<?php echo url('app-assets/potocalegroot/ok.png')?>" alt="logo" width="100" class="shadow-light rounded-circle"></center>
                                <h2 class="card-title fw-bold mb-1">SIGN IN</h2>
                                <p class="card-text mb-2">Silakan login menggunakan Username yang terdaftar</p>
                                <form action="{{url('loginproses')}}" name="loginadmin" id="loginadmin" method="post">
                                    {{csrf_field()}}
                                    @if (session('logingagal'))
                                    <div class="alert alert-danger">
                                        {{ session('logingagal') }}
                                    </div>
                                    @endif
                                    <div class="mb-1">
                                        <label class="form-label" for="username">Username</label>
                                        <input class="form-control" id="username" type="text" name="username" placeholder="Username" aria-describedby="login-email" autofocus="" tabindex="1" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="Password" aria-describedby="login-password" tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-login w-100" tabindex="4">Login</button>
                                </form>
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{url('app-assets/login/vendors/js/vendors.min.js')}}"></script>
    <script src="{{url('app-assets/login/vendors/js/jquery/jquery.min.js')}}"></script>
    <script src="{{url('app-assets/login/vendors/js/jquery/jquery.form.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{url('app-assets/login/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <script src="{{url('app-assets/login/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{url('app-assets/login/js/core/app-menu.js')}}"></script>
    <script src="{{url('app-assets/login/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{url('app-assets/login/js/scripts/pages/auth-login1.js')}}"></script>
    <!-- END: Page JS-->

    
    <!-- Page Specific JS File -->
    <script>
        $(function() {
            $("#loginform").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                var data = $(this).serialize();

                $.ajax({
                    url: url,
                    type: method,
                    data: data
                }).done(function(data) {
                    if (data !== '') {
                        $("#response").css('visibility', 'visible');
                        $('#loginform')[0].reset();
                    }
                });
            });

            $("div").each(function(index) {
                var cl = $(this).attr('class');
                if (cl == '') {
                    $(this).hide();
                }
            });

        });
    </script>
</body>
<!-- END: Body-->

</html>