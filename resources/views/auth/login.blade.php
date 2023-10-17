<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asmi App | Login</title>

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

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-orange">
            <div class="card-header text-center">
                <a href="" class="h1"><b>Aristo</b>App</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg @error('login') pb-0 @enderror">Masuk untuk menggunakan app</p>
                @error('login')
                    <p class="login-box-msg m-0 text-danger font-weight-bold" style="padding-bottom: 20px;">
                        {{ $message }}</p>
                @enderror

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="nik"
                            class="form-control @error('nik') is-invalid @enderror" id="nik"
                            placeholder="Nomor Induk Karyawan (NIK)" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-at"></i>
                            </div>
                        </div>
                        @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> <!-- /.input-group -->
                    <div class="input-group mb-3">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="Password" autocomplete="off">
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
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-success btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                        {{-- <div class="col-8 text-right">
                            <p class="mb-0">
                                <a href="{{ route('register') }}" class="text-center">Buat akun baru</a>
                            </p>
                        </div> --}}
                        <!-- /.col -->
                    </div>
                </form>

                {{-- <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p> --}}

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
