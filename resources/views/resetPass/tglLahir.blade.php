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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            width: 90%;
            max-width: 400px;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        p {
            color: #ccc;
            margin-bottom: 30px;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #f5d28b;
            border-radius: 8px;
            background-color: #000;
            color: #fff;
            font-size: 1rem;
            margin-bottom: 20px;
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
        <p>Masukkan Username dan Tanggal Lahir<br>untuk me-reset password Anda.</p>

        <form action="{{ route('reset.tanggal.kirim') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Masukkan Username" required>
            <input type="date" name="tanggal_lahir" required>
            <button type="submit">Continue</button>
        </form>

        <a href="{{ url('/login-regis') }}">Back to login page</a>
    </div>
</body>
</html>
