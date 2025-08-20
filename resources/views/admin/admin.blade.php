<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'E-Perpustakaan') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0ea5e9',
                        dark: '#0c4a6e',
                        light: '#f9fafb'
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="bg-light min-h-screen flex flex-col">

    <!-- Kontainer utama yang memaksa isi membentang penuh -->
    <div class="flex flex-col min-h-screen">

        <!-- Konten utama -->
        <main class="flex-1">
            @yield('content')
        </main>


    </div>

    <script>feather.replace();</script>
</body>
</html>
