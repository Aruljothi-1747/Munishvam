<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Secure OTP</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="adminlte/css/adminlte.min.css">

    <style>
    /* Global Styles */
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #D3D3D3;
        /* Light Gray */
        margin: 0;
        font-family: 'Source Sans Pro', sans-serif;
        padding: 1rem;
    }

    .login-box {
        width: 100%;
        max-width: 380px;
    }

    .login-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        padding: 2rem;
        text-align: center;
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-card h1 {
        font-size: 1.8rem;
        color: #679d06;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .login-card h2 {
        font-size: 1.4rem;
        color: #333;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .login-card p {
        color: #666;
        margin-bottom: 1.5rem;
        font-size: 1rem;
    }

    .input-group {
        position: relative;
        margin-bottom: 1rem;
    }

    .input-group input {
        width: 100%;
        padding: 12px 15px;
        font-size: 1rem;
        border: 2px solid #ccc;
        border-radius: 8px;
        outline: none;
        transition: border 0.3s ease-in-out;
    }

    .input-group input:focus {
        border-color: #679d06;
        box-shadow: 0 0 8px rgba(103, 157, 6, 0.5);
    }

    .input-group i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }

    .btn-login {
        background-color: #679d06;
        color: white;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
        font-size: 1rem;
        font-weight: bold;
        width: 100%;
    }

    .btn-login:hover {
        background-color: #567c05;
        transform: scale(1.05);
    }

    .error-message {
        background-color: #ffcccc;
        color: #cc0000;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 1rem;
    }

    .resend {
        margin-top: 1rem;
        font-size: 0.9rem;
        color: #666;
    }

    .resend a {
        color: #679d06;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s;
    }

    .resend a:hover {
        color: #456b03;
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 480px) {
        .login-card {
            padding: 1.5rem;
        }

        .btn-login {
            padding: 0.7rem;
            font-size: 0.9rem;
        }
    }
    </style>
</head>

<body>

    <div class="login-box">
        <div class="login-card">
            <h1>Munishvam.com</h1>
            <hr>
            <h2>🔐 Secure Login</h2>
            <p>Enter your mobile number to receive a one-time password (OTP).</p>

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('otp.send') }}" method="POST">
                @csrf

                <div class="input-group">
                    <input type="text" placeholder="📱 Mobile Number" value="{{ old('phonenumber') }}"
                        name="phonenumber" required>
                    <i class="fas fa-phone-alt"></i>
                </div>

                <button type="submit" class="btn-login">Send OTP</button>
            </form>

            <div class="resend">
                Didn't receive the OTP? <a href="#">Resend OTP</a>
            </div>
        </div>
    </div>

</body>

</html>