<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>GIS Rumah Sakit Semarang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="flex h-screen">

        <aside class="w-72 bg-white border-r shadow-sm flex flex-col z-20">

            <div class="flex items-center gap-3 px-6 py-5 border-b">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-lg flex items-center justify-center text-white text-xl font-bold">
                    <i class="fas fa-map"></i>
                </div>
                <h1 class="text-xl font-bold">SIGIS</h1>
            </div>

            <nav class="mt-4 flex-1 space-y-1">
                
                {{-- MENU PETA --}}
                <a href="{{ route('peta') }}"
                    class="flex items-center gap-3 px-6 py-3 transition-colors duration-200
                    {{ Route::is('peta') 
                        ? 'text-blue-600 bg-blue-50 border-l-4 border-blue-600' 
                        : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600 border-l-4 border-transparent' 
                    }}">
                    <i class="fas fa-map-location-dot w-6"></i>
                    <span class="font-medium">Peta</span>
                </a>

                {{-- MENU LOKASI --}}
                <a href="{{ route('lokasi') }}"
                    class="flex items-center gap-3 px-6 py-3 transition-colors duration-200
                    {{ Route::is('lokasi') 
                        ? 'text-blue-600 bg-blue-50 border-l-4 border-blue-600' 
                        : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600 border-l-4 border-transparent' 
                    }}">
                    <i class="fas fa-location-dot w-6"></i>
                    <span class="font-medium">Lokasi</span>
                </a>

            </nav>

            <div class="px-6 py-4 text-sm text-gray-400 border-t">
                © 2025 SIGIS
            </div>

        </aside>

        <main class="flex-1 overflow-y-auto bg-gray-50 relative">
            @yield('content')
        </main>

    </div>

</body>

</html>