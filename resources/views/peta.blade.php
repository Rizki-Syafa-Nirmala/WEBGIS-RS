@extends('layout.app')

@section('content')

<header class="bg-white px-6 py-4 border-b shadow-sm flex items-center">
    <div class="relative w-full max-w-md">
        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
        <input type="text" id="search-input" placeholder="Cari rumah sakit..."
            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
    </div>
</header>

<div class="flex-1 relative h-[calc(100vh-80px)]">
    <div id="map" class="absolute inset-0"></div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    // ==========================================
    // 1. DEFINISI IKON WARNA (BAGIAN BARU)
    // ==========================================
    const iconBase = {
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    };

    // Definisi URL gambar untuk tiap warna
    const redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        ...iconBase
    });

    const greenIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        ...iconBase
    });

    const yellowIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-gold.png',
        ...iconBase
    });

    const blueIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
        ...iconBase
    });

    // ==========================================
    // 2. FUNGSI PEMILIH WARNA (BAGIAN BARU)
    // ==========================================
    function getIconByAmenity(amenityString) {
        if (!amenityString) return blueIcon;

        const amenity = amenityString.toLowerCase();

        // Logika sesuai data CSV kamu:
        // Merah: Rumah Sakit, RS Jiwa, RS Ibu & Anak, RS Gigi & Mulut
        if (amenity.includes('rumah sakit') || amenity.includes('rs ') || amenity.includes('bersalin')) {
            return redIcon;
        } 
        // Hijau: Klinik Umum, Klinik Mata, Klinik Gigi
        else if (amenity.includes('klinik')) {
            return greenIcon;
        } 
        // Kuning: Puskesmas
        else if (amenity.includes('puskesmas')) {
             return yellowIcon;
        } 
        // Default Biru
        else {
            return blueIcon;
        }
    }

    // ==========================================
    // 3. LOGIKA UTAMA PETA
    // ==========================================
    
    // Inisialisasi Peta
    var map = L.map('map').setView([-6.993, 110.420], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    // Ambil data dari Controller
    var allRumahSakit = @json($rumahsakits);

    // Buat LayerGroup
    var markersLayer = L.layerGroup().addTo(map);

    // Fungsi Render Marker (DIPERBARUI)
    function renderMarkers(data) {
        markersLayer.clearLayers();

        data.forEach(function (rs) {
            if(rs.latitude && rs.longitude) {
                var popupContent = `
                    <b class="text-blue-600">${rs.nama_rs}</b><br>
                    <span class="text-sm text-gray-700">Alamat: ${rs.alamat}</span><br>
                    <span class="text-sm">Amenity: <b>${rs.amenity}</b></span>
                `;

                // [BARU] Memilih ikon sebelum membuat marker
                var selectedIcon = getIconByAmenity(rs.amenity);

                // [BARU] Menambahkan opsi {icon: ...}
                var marker = L.marker([rs.latitude, rs.longitude], { icon: selectedIcon })
                    .bindPopup(popupContent);
                
                markersLayer.addLayer(marker);
            }
        });
    }

    // Tampilkan awal
    renderMarkers(allRumahSakit);

    // Logika Pencarian
    const searchInput = document.getElementById('search-input');

    searchInput.addEventListener('input', function(e) {
        const keyword = e.target.value.toLowerCase();

        const filteredData = allRumahSakit.filter(function(rs) {
            // Tips: Saya tambahkan pencarian amenity juga, jadi user bisa cari "Puskesmas"
            return rs.nama_rs.toLowerCase().includes(keyword) || 
                   (rs.amenity && rs.amenity.toLowerCase().includes(keyword));
        });

        renderMarkers(filteredData);
    });
</script>

@endsection