<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel')</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- CSS Global --}}
    <style>
        :root {
            --gold: #ef9f27;
            --gold-glow: rgba(239,159,39,0.35);
            --navy: #3c3489;
            --white: #ffffff;
            --bg: #fffaf0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(180deg, #fffefb, #fff7e8);
            color: #2b2b2b;
            min-height: 100vh;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        .container {
            width: 100%;
            min-height: 100vh;
            position: relative;
        }
    </style>

    {{-- Tempat style dari halaman --}}
    @stack('styles')
</head>
<body>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>