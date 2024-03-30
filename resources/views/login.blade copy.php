
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="INTEGRATED APPLICATION">
    <meta name="keywords" content="percetakan, aplikasi, software">
    <meta name="author" content="ASH">
    <title>Login - Stisla</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{url('app-assets/img/ico/favicon.ico')}}">
    <link rel="shortcut icon" type="image/png" href="{{('app-assets/img/ico/favicon-32.png')}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{('app-assets/admin/login.css')}}">

    <!-- CSS Libraries
    <link rel="stylesheet" href="{{('app-assets/stisla/node_modules/bootstrap-social/bootstrap-social.css')}}"> -->

    <!-- Template CSS-->
    <link rel="stylesheet" href="{{('app-assets/admin/style.css')}}">
    <link rel="stylesheet" href="{{('app-assets/admin/components.css')}}"> 


  <link rel="stylesheet" href="{{('app-assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{('app-assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{('app-assets/admin/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>


    <body class="hold-transition login-body">
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="login-brand">
                                <img src="{{('app-assets/potocalegroot/ok.png')}}" alt="logo" width="100" class="shadow-light rounded-circle">
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3>LOGIN</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{url('loginproses')}}" name="loginadmin" id="loginadmin" method="post">
                                    {{csrf_field()}}
                                    @if (session('logingagal'))
                                    <div class="alert alert-danger">
                                        {{ session('logingagal') }}
                                    </div>
                                    @endif
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input id="username" type="text" class="form-control" name="username" tabindex="1">
                                        </div>
                                        <div class="form-group">
                                            <div class="d-block">
                                                <label for="password" class="control-label">Password</label>
                                            </div>
                                            <input id="password" type="password" class="form-control" name="password" tabindex="2">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                    <div class="text-center" style="visibility: hidden;" id="response">salah! </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>



    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <!-- General JS Scripts 
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{('app-assets/stisla/assets/js/stisla.js')}}"></script>-->

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{('app-assets/admin/scripts.js')}}"></script>
    <script src="{{('app-assets/admin/custom.js')}}"></script>

<!-- jQuery -->
<script src="{{('app-assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{('app-assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{('app-assets/admin/dist/js/adminlte.min.js')}}"></script>

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
</html>
