<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrace - Sistem Kebiasaan Belajar</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3D2C6B',
                        secondary: '#5B4A8A',
                        accent: '#F5A623',
                        purple: '#7C5CDB'
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">
    @include('page.landing.components.navbar')
    @include('page.landing.components.hero')
    <main class="space-y-20 px-4 pb-16 md:px-8 lg:px-12">
        @include('page.landing.components.features')
        @include('page.landing.components.goals')
        @include('page.landing.components.faq')
    </main>
    @include('page.landing.components.footer')
</body>

</html>
