@extends('layout.app')

@section('content')

<!-- HEADER -->
<header class="bg-white px-6 py-4 border-b shadow-sm flex items-center">
    <div class="relative w-full max-w-md">
        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
        <input type="text" placeholder="Cari rumah sakit..."
            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
    </div>
</header>

<!-- MAP -->
<div class="flex-1 relative h-[calc(100vh-80px)]">
    <div id="map" class="absolute inset-0"></div>
</div>

<!-- Leaflet JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    var map = L.map('map').setView([-6.993, 110.420], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    var rumahsakit = @json($rumahsakits);

    rumahsakit.forEach(function (rs) {
        var popupContent = `
            <b class="text-blue-600">${rs.nama_rs}</b><br>
            <span class="text-sm text-gray-700">Alamat: ${rs.alamat}</span><br>
            <span class="text-sm">Detail Dokter: ${rs.detail_dokter}</span><br>
            <span class="text-sm">Fasilitas Unggulan: ${rs.fasilitas_unggulan}</span><br>
            <span class="text-sm">Amenity: ${rs.amenity}</span>
        `;

        L.marker([rs.latitude, rs.longitude])
            .addTo(map)
            .bindPopup(popupContent);
    });
</script>

@endsection
