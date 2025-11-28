<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS Rumah Sakit Semarang</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* RESET STYLES */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* COLORS */
        :root {
            --primary: #3B82F6;
            --primary-dark: #1E40AF;
            --secondary: #06B6D4;
            --danger: #EF4444;
            --warning: #F59E0B;
            --success: #10B981;
            --dark: #1F2937;
            --light: #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-300: #D1D5DB;
            --gray-400: #9CA3AF;
            --gray-600: #4B5563;
            --white: #FFFFFF;
        }

        /* BASIC STYLES */
        body {
            font-family: sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            background: var(--white);
            border-right: 1px solid var(--gray-200);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
            font-size: 20px;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
        }

        .nav-section {
            padding: 16px 0;
        }

        .nav-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--gray-600);
            text-decoration: none;
            border-left: 3px solid transparent;
        }

        .nav-item:hover {
            background-color: var(--gray-100);
            color: var(--primary);
        }

        .nav-item.active {
            background-color: #EFF6FF;
            color: var(--primary);
            border-left-color: var(--primary);
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .header {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1;
        }

        .search-box {
            flex: 1;
            max-width: 400px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background-color: var(--gray-100);
        }

        .search-input:focus {
            outline: none;
            background-color: var(--white);
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 16px;
        }

        /* MAP CONTAINER */
        .map-wrapper {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        #map {
            width: 100%;
            height: 100%;
        }

    </style>
</head>

<body>
    <div class="container">
        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-map"></i>
                </div>
                <div class="logo-text">SIGIS</div>
            </div>

            <div class="nav-section">
                <a class="nav-item active" href="#peta">
                    <div class="nav-icon"><i class="fas fa-map-location-dot"></i></div>
                    <span>Peta</span>
                </a>
            </div>
            <div class="nav-section">
                <a class="nav-item" href="#lokasi">
                    <div class="nav-icon"><i class="fas fa-location-dot"></i></div>
                    <span>Lokasi</span>
                </a>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <!-- HEADER -->
            <div class="header">
                <div class="header-left">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Masukkan nama rumah sakit...">
                    </div>
                </div>
            </div>

            <!-- MAP -->
            <div class="map-wrapper">
                <div id="map"></div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([-6.993, 110.420], 12); // Lokasi Semarang

        // Menambahkan tile layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        // Mengambil data rumah sakit dan menambahkan marker
        var rumahsakit = @json($rumahsakits); // Mengubah data PHP ke format JavaScript

        rumahsakit.forEach(function(rumahsakit) {
            // Menggabungkan informasi untuk bindPopup
            var popupContent = '<b>' + rumahsakit.nama_rs + '</b><br>' +
                            'Alamat: ' + rumahsakit.alamat + '<br>' +
                            'Amenity: ' + rumahsakit.amenity;

            // Menambahkan marker ke peta dan bind popup
            L.marker([rumahsakit.latitude, rumahsakit.longitude])
                .addTo(map)
                .bindPopup(popupContent); // Menggunakan string HTML yang telah digabungkan
        });

    </script>
</body>

</html>
