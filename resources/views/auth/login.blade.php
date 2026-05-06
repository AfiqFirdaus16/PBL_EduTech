<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #3c2f8f, #f9a826);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: #f4f4f4;
            padding: 40px 30px;
            border-radius: 15px;
            width: 350px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .login-card img {
            width: 80px;
            margin-bottom: 10px;
        }

        .login-card h2 {
            margin-bottom: 20px;
            color: #3c2f8f;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .form-options a {
            text-decoration: none;
            color: #3c2f8f;
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            background: #f9a826;
            border: none;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #e69500;
        }

        .register {
            margin-top: 10px;
            font-size: 13px;
        }

        .register a {
            color: #3c2f8f;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="login-card">
    <!-- Logo -->
    <img src="{{ asset('images/edutrace.png') }}" alt="logo">

    <h2>Login</h2>
    <!--menampilkan pesan sukses-->
    @if(session('success'))
        <p style="color:green; text-align:center;">
            {{ session('success') }}
        </p>
    @endif

    <!--menampilkan pesan error-->
    @if(session('error'))
        <p style="color:red; text-align:center;">
            {{ session('error') }}
        </p>
    @endif
    
    <form method="POST" action="{{ route('login.process') }}">
        @csrf

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-options">
            <label>
                <input type="checkbox"> Ingatkan saya
            </label>
            <a href="#">Lupa Password?</a>
        </div>

        <button type="submit" class="btn-login">Masuk</button>

        <div class="register">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>
    </form>
</div>

</body>
</html>