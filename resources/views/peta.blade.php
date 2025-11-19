<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS Rumah Sakit Semarang</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
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
            box-shadow: var(--shadow-sm);
            z-index: 100;
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

        .nav-section-title {
            padding: 8px 20px;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-400);
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 20px;
            border-top: 1px solid var(--gray-200);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .user-profile:hover {
            background-color: var(--gray-100);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
            font-size: 16px;
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark);
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            color: var(--gray-400);
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* HEADER */
        .header {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow-sm);
            z-index: 50;
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

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-action {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            border: none;
            background: var(--gray-100);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: var(--gray-600);
            transition: all 0.2s;
        }

        .header-action:hover {
            background: var(--gray-200);
            color: var(--dark);
        }

        .header-divider {
            width: 1px;
            height: 24px;
            background: var(--gray-200);
        }

        .user-profile-header {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .user-avatar-header {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--warning) 0%, var(--danger) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
            font-size: 14px;
        }

        .user-name-header {
            font-weight: 500;
            color: var(--dark);
            font-size: 14px;
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
            z-index: 1;
        }

        /* CUSTOM MAP CONTROLS */
        .leaflet-control {
            border: none !important;
            box-shadow: var(--shadow-md) !important;
            border-radius: 8px !important;
            background: var(--white) !important;
        }

        .leaflet-control-zoom-in,
        .leaflet-control-zoom-out {
            background-color: var(--white) !important;
            border: none !important;
            width: 40px !important;
            height: 40px !important;
            line-height: 40px !important;
            color: var(--primary) !important;
            font-weight: bold !important;
            font-size: 18px !important;
            transition: all 0.2s !important;
        }

        .leaflet-control-zoom-in:hover,
        .leaflet-control-zoom-out:hover {
            background-color: var(--gray-100) !important;
            color: var(--primary-dark) !important;
        }

        .leaflet-popup-content-wrapper {
            background-color: var(--white) !important;
            border-radius: 8px !important;
            box-shadow: var(--shadow-lg) !important;
            border: none !important;
        }

        .leaflet-popup-content {
            margin: 0 !important;
            line-height: 1.5 !important;
        }

        .leaflet-popup-tip {
            background-color: var(--white) !important;
            border: none !important;
        }

        .leaflet-marker-icon {
            filter: drop-shadow(var(--shadow-md));
            transition: transform 0.2s;
        }

        .leaflet-marker-icon:hover {
            transform: scale(1.1);
        }

        /* CUSTOM MARKER */
        .custom-marker {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: 3px solid var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 16px;
            box-shadow: var(--shadow-lg);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                flex-direction: row;
                max-height: 70px;
                overflow-x: auto;
                border-right: none;
                border-bottom: 1px solid var(--gray-200);
            }

            .sidebar-header {
                border-bottom: none;
            }

            .nav-section {
                display: flex;
                gap: 0;
            }

            .nav-section-title {
                display: none;
            }

            .sidebar-bottom {
                border-top: none;
                border-left: 1px solid var(--gray-200);
                padding: 8px 20px;
            }

            .user-info {
                display: none;
            }

            .search-box {
                max-width: 200px;
            }

            .user-name-header {
                display: none;
            }
        }

        /* SCROLLBAR */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--gray-400);
        }

        /* ANIMATIONS */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .nav-item {
            animation: slideIn 0.3s ease forwards;
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
                <div class="nav-section-title">Menu Utama</div>
                <a class="nav-item active" href="#peta">
                    <div class="nav-icon"><i class="fas fa-map-location-dot"></i></div>
                    <span>Peta</span>
                </a>
            </div>
            <div class="nav-section">
                <div class="nav-section-title">Data</div>
                    <a class="nav-item" href="{{ route('lokasi.index') }}">Lokasi</a>
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

    <script>
        // Initialize map
        var map = L.map('map').setView([-6.993, 110.420], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        // Fetch and display hospitals
        fetch("/api/rumah-sakit")
            .then(res => res.json())
            .then(data => {
                data.forEach((rs, index) => {
                    let popupContent = `
                        <div style="min-width: 200px;">
                            <div style="margin-bottom: 12px;">
                                <h3 style="margin: 0 0 4px 0; color: #1f2937; font-size: 16px; font-weight: 600;">${rs.nama}</h3>
                                <p style="margin: 0 0 8px 0; color: #6b7280; font-size: 13px;">${rs.alamat}</p>
                                <p style="margin: 0; color: #6b7280; font-size: 13px;"><strong>Telp:</strong> ${rs.no_telp ?? '-'}</p>
                            </div>
                            <img src="${rs.gambar}" style="width:100%; border-radius: 8px; margin-top: 8px; max-height: 150px; object-fit: cover;">
                        </div>
                    `;

                    const marker = L.circleMarker([rs.latitude, rs.longitude], {
                        radius: 8,
                        fillColor: index % 2 === 0 ? '#3B82F6' : '#06B6D4',
                        color: '#fff',
                        weight: 3,
                        opacity: 1,
                        fillOpacity: 0.8
                    })
                    .addTo(map)
                    .bindPopup(popupContent, {
                        maxWidth: 300,
                        className: 'custom-popup'
                    });

                    marker.on('click', function() {
                        this.openPopup();
                    });
                });
            })
            .catch(err => console.error('Error loading hospitals:', err));

        // Search functionality
        document.querySelector('.search-input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            console.log('Searching for:', searchTerm);
        });

        // Navigation items
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>