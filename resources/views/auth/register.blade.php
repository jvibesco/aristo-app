<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asmi App | Register</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <span class="h1"><b>Aristo</b>App</span>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Buat akun baru</p>

                <form action="{{ route('register.store') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="fullname" value="{{ old('fullname') }}"
                            class="form-control @error('fullname') is-invalid @enderror" id="fullname"
                            placeholder="Nama Lengkap" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-at"></i>
                            </div>
                        </div>
                        @error('fullname')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> <!-- /.input-group -->

                    <div class="input-group mb-3">
                        <input type="text" name="username" value="{{ old('username') }}"
                            class="form-control @error('username') is-invalid @enderror" id="username"
                            placeholder="Username" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-at"></i>
                            </div>
                        </div>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> <!-- /.input-group -->
                    <div class="input-group mb-3">
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email"
                            autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> <!-- /.input-group -->
                    <div class="input-group mb-3">
                        <input type="password" name="password" value="{{ old('password') }}"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> <!-- /.input-group -->
                    <div class="input-group mb-3">
                        <input type="text" name="password2" value="{{ old('password2') }}"
                            class="form-control @error('password') is-invalid @enderror" id="password2"
                            placeholder="Confirmation Password" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> <!-- /.input-group -->
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="{{ route('login') }}" class="text-center">Sudah punya akun?</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
