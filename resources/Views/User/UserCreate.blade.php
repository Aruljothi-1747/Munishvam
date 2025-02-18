<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="adminlte/css/adminlte.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <a href="#" class="login-box-msg">
            <h1 class="text-bold" style="  color: #679d06;">AmirthamHub

            </h1>
            <hr>
        </a>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>
                <form method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" required
                            placeholder="Full Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </span>



                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ old('phonenumber') }}" id="phonenumber"
                            name="phonenumber" required placeholder="Phone Number">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">
                        @error('phonenumber')
                        {{ $message }}
                        @enderror
                    </span>

                    <div class="input-group mb-3" style="display:none;">
                        <input type="text" class="form-control" value="Client" id="role" name="role" placeholder="role">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-eye" id="togglePassword"></i>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </span>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password"
                            name="confirmpassword" id="confirmpassword" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">
                        @error('confirmpassword')
                        {{ $message }}
                        @enderror
                    </span>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('user.login') }}" class="">Go to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function(e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const confirmPassword = document.querySelector('#confirmpassword');
    toggleConfirmPassword.addEventListener('click', function(e) {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
    </script>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>