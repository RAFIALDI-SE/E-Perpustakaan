<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'E-Perpustakaan') }}</title>

    <!-- Tailwind CSS CDN + Custom Warna -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0ea5e9', // Warna utama (digunakan untuk header & footer)
                        dark: '#0c4a6e',
                        light: '#f9fafb'
                    }
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="bg-light text-gray-900 min-h-screen flex flex-col">

    <div class="flex flex-col min-h-screen">

        <!-- Header -->
        <header class="bg-primary text-white py-4 text-center shadow-md">
            <h1 class="text-2xl font-bold">E-Perpustakaan</h1>
        </header>

        <!-- Konten Utama -->
        <main class="flex-1 p-4">
            @yield('content')
        </main>

        <!-- Footer (disamakan dengan header) -->
        <footer class="bg-primary text-white py-4 text-center shadow-inner">
            <p>&copy; {{ date('Y') }} E-Perpustakaan. All rights reserved.</p>
        </footer>
    </div>

    <script>feather.replace();</script>
</body>
</html>
