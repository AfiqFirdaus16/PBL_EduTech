<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
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
            padding: 40px 30px;
            border-radius: 15px;
            width: 350px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .card img {
            width: 80px;
            margin-bottom: 10px;
        }

        .card h2 {
            margin-bottom: 20px;
            color: #3c2f8f;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 5px;
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
        }

        .btn:hover {
            background: #e69500;
        }

        .link {
            margin-top: 10px;
            font-size: 13px;
        }

        .link a {
            color: #3c2f8f;
            text-decoration: none;
        }

        .alert-success {
            color: green;
            margin-bottom: 10px;
        }

        .alert-error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="card">
    <img src="{{ asset('images/edutrace.png') }}" alt="logo">

    <h2>@yield('title')</h2>

    {{-- SUCCESS --}}
    @if(session('success'))
        <p class="alert-success">{{ session('success') }}</p>
    @endif

    {{-- ERROR --}}
    @if(session('error'))
        <p class="alert-error">{{ session('error') }}</p>
    @endif

    @yield('content')
</div>

</body>
</html>