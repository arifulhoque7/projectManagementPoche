@if (session()->has('email'))
    <script>
        window.location = "{{ route('dashboard') }}";
    </script>
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poche Architechture | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/adminlte.min.css') }}">
    <!-- icheck bootstrap -->

    <!-- Theme style -->
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="{{ url('/images/poche_blck.svg') }}" alt="" style="max-width: 130px;">
                {{-- <a href="" class="h3"><b>Poche</b> Architechture</a> --}}
                <div class="alert alert-danger mt-4" id="errorDivForLogin">

                </div>
            </div>


            <div class="card-body">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Email/Phone" id="email"
                        value="{{ old('text') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password"
                        value="{{ old('password') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button class="btn btn-primary btn-block" onclick="submitLogin()">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>


                {{-- <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> --}}
                <!-- /.social-auth-links -->

                {{-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p> --}}
                {{-- <p class="mb-1">
                    <a href="{{ route('admin.login.view') }}">Log in as a Admin</a>
                </p> --}}
                {{-- <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ URL::asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('admin/dist/js/adminlte.min.js') }}"></script>

    <script type="text/javascript">
        

        $('#errorDivForLogin').hide();


        function submitLogin() {
            var email = $("#email").val();
            var password = $("#password").val();
            var checked = '';
            var isChecked = $("#remember").is(":checked");
            if (isChecked) {
               checked = 'true';
            } else {
                checked = 'false';
            }

            var _token = $('input[name=_token]').val();

            $.ajax({
                method: "POST",
                url: "{{ route('login.check.credential') }}",
                data: {
                    email: email,
                    password: password,
                    checked: checked,
                    _token: _token
                },
                success: function(response) {
                    if (response.status == 'false') {
                        $('#errorDivForLogin').text(response.message);
                        $('#errorDivForLogin').show();
                    } else {
                        window.location.href = "{{ route('dashboard') }}";
                    }
                },

                error: function(response) {
                    console.log(response);
                    $('#errorDivForLogin').text(response.responseJSON.errors.file);
                }
            });
        };
    </script>

</body>

</html>
