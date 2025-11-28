<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>GIS Rumah Sakit Semarang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>

<body class="bg-gray-100 text-gray-800">

    <div class="flex h-screen">

        <!-- SIDEBAR -->
        <aside class="w-72 bg-white border-r shadow-sm flex flex-col">

            <!-- Logo -->
            <div class="flex items-center gap-3 px-6 py-5 border-b">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-lg flex items-center justify-center text-white text-xl font-bold">
                    <i class="fas fa-map"></i>
                </div>
                <h1 class="text-xl font-bold">SIGIS</h1>
            </div>

            <!-- Menu -->
            <nav class="mt-4 flex-1">
                <a href="{{ route('peta') }}"
                    class="flex items-center gap-3 px-6 py-3 text-blue-600 bg-blue-50 border-l-4 border-blue-600">
                    <i class="fas fa-map-location-dot"></i>
                    <span class="font-medium">Peta</span>
                </a>

                <a href="{{ route('lokasi') }}"
                    class="flex items-center gap-3 px-6 py-3 text-gray-600 hover:bg-gray-100 hover:text-blue-600 transition">
                    <i class="fas fa-location-dot"></i>
                    <span>Lokasi</span>
                </a>
            </nav>

            <!-- Footer -->
            <div class="px-6 py-4 text-sm text-gray-400 border-t">
                © 2025 SIGIS
            </div>

        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 overflow-y-scroll">
            @yield('content')
        </main>

    </div>

   

</body>

</html>
