<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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

        .card {
            background: #f4f4f4;
            padding: 30px;
            border-radius: 15px;
            width: 380px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #3c2f8f;
        }

        .form-group {
            margin-bottom: 12px;
        }

        label {
            font-size: 13px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        .row {
            display: flex;
            gap: 10px;
        }

        .row .form-group {
            flex: 1;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #f9a826;
            border: none;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background: #e69500;
        }

        .login-link {
            text-align: center;
            font-size: 13px;
            margin-top: 10px;
        }

        .login-link a {
            color: #3c2f8f;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Register</h2>

    <form onsubmit="event.preventDefault(); window.location.href='{{ route('login') }}';">
        @csrf

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>
        </div>

        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" required>
        </div>

        <div class="row">
            <div class="form-group">
                <label>Jenjang</label>
                <select name="jenjang">
                    <option>SMP</option>
                    <option>SMA</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tingkat</label>
                <select name="tingkat">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Email Aktif</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn">Daftar</button>

        <div class="login-link">
            Sudah punya akun? 
            <a href="{{ route('login') }}">Masuk</a>
        </div>
    </form>
</div>

</body>
</html>