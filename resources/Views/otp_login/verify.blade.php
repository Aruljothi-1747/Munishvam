<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - Secure Login</title>
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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 1rem;
    }

    .otp-container {
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        text-align: center;
        width: 100%;
        max-width: 400px;
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

    .otp-container h1 {
        color: #333;
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }

    .otp-container p {
        color: #666;
        margin-bottom: 1.5rem;
        font-size: 1rem;
    }

    .otp-inputs {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 1.5rem;
    }

    .otp-inputs input {
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
        text-align: center;
        border: 2px solid #ccc;
        border-radius: 8px;
        outline: none;
        transition: all 0.3s ease-in-out;
        font-weight: bold;
        background-color: #f9f9f9;
    }

    .otp-inputs input:focus {
        border-color: #007BFF;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        transform: scale(1.1);
    }

    .otp-container button {
        background-color: #007BFF;
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

    .otp-container button:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .otp-container .resend {
        margin-top: 1rem;
        font-size: 0.9rem;
        color: #666;
    }

    .otp-container .resend a {
        color: #007BFF;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s;
    }

    .otp-container .resend a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 480px) {
        .otp-container {
            padding: 1.5rem;
        }

        .otp-inputs {
            gap: 8px;
        }

        .otp-inputs input {
            width: 45px;
            height: 45px;
            font-size: 1.3rem;
        }

        .otp-container button {
            padding: 0.7rem;
            font-size: 0.9rem;
        }
    }
    </style>
</head>

<body>

    <div class="otp-container">
        <h1>🔐 Secure Login</h1>
        <p>Please enter the 4-digit OTP sent to your mobile number.</p>
        <form action="{{ route('otp.verify') }}" method="POST">
            @csrf
            <div class="otp-inputs">
                <input type="text" name="otp1" maxlength="1" required oninput="moveToNext(this, 'otp2')">
                <input type="text" name="otp2" maxlength="1" required oninput="moveToNext(this, 'otp3')">
                <input type="text" name="otp3" maxlength="1" required oninput="moveToNext(this, 'otp4')">
                <input type="text" name="otp4" maxlength="1" required oninput="moveToNext(this, '')">
            </div>
            <input type="hidden" name="otp" id="otp-hidden">
            <button type="submit" onclick="combineOTP()">Verify OTP</button>
        </form>
        <div class="resend">
            Didn't receive the code? <a href="#">Resend OTP</a>
        </div>
    </div>

    <script>
    function moveToNext(current, nextFieldId) {
        if (current.value.length === 1) {
            if (nextFieldId) {
                document.getElementsByName(nextFieldId)[0].focus();
            }
        }
    }

    function combineOTP() {
        let otp = '';
        document.querySelectorAll('.otp-inputs input').forEach(input => {
            otp += input.value;
        });
        document.getElementById('otp-hidden').value = otp;
    }
    </script>

</body>

</html>