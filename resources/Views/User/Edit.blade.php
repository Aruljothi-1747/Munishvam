@extends('adminLTE.adminLTE_layout')
@section('Tittle')
Users
@endsection

<!--Main Content-->
@section('maincontent')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @error('password')
                    <div class="text-danger">The password must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character.</div>
                    @enderror
                    <form method="POST" action="{{ route('user.update',$user->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="{{ $user->name }}" id="name" name="name" required placeholder="Name">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" value="{{ $user->email }}" id="email" name="email" required placeholder="Email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Confirm Password" value="{{ $user->confirmpassword }}" name="confirmpassword" id="confirmpassword">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Password" value="{{ $user->confirmpassword }}" name="password" id="password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fas fa-eye" id="togglePassword"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('user.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
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
@endsection