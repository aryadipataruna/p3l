<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            background-color: #000;
            color: #f5d28b;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 20px 0;
            background: black;
            color: white;
            border: 1px solid #f5d28b;
            border-radius: 8px;
        }

        button {
            background-color: #d4af72;
            border: none;
            border-radius: 12px;
            padding: 12px 0;
            width: 100%;
            font-size: 1rem;
            color: #000;
            font-weight: bold;
            cursor: pointer;
        }

        a {
            display: block;
            margin-top: 15px;
            color: #ccc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reset Password</h1>
        <p>Enter your Email address and we will send you<br>instructions to reset your password.</p>

        @if (session('status'))
            <p style="color: green;">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input type="email" name="email" placeholder="Masukkan email Anda" required>
            <button type="submit">Continue</button>
        </form>

        <a href="{{ url('/login-regis') }}">Back to login page</a>
    </div>
</body>
</html>
