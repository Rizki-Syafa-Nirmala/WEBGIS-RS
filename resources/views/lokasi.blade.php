@extends('layout.app')

@section('content')
<div class="p-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Lokasi Rumah Sakit</h2>
            <p class="text-sm text-gray-500">Data rumah sakit yang terdaftar dalam sistem</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <form action="{{ route('lokasi') }}" method="GET" class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari nama, alamat..."
                    class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-200 text-sm w-full sm:w-64">
            </form>

            <a href="{{ route('peta') }}"
               class="inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow text-sm">
                <i class="fas fa-map-marked-alt"></i>
                Lihat Peta
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden border border-gray-100">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-700 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-6 py-4 font-semibold">No</th>
                        <th class="px-6 py-4 font-semibold">Nama Rumah Sakit</th>
                        <th class="px-6 py-4 font-semibold">Alamat</th>
                        <th class="px-6 py-4 font-semibold">Amenity</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">

                    @forelse($rumahsakit as $index => $rs)
                    <tr class="hover:bg-blue-50 transition duration-150">
                        <td class="px-6 py-4 font-medium text-gray-500">
                            {{ $rumahsakit->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800">{{ $rs->nama_rs }}</div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 max-w-xs truncate">
                            {{ $rs->alamat }}
                        </td>
                        <td class="px-6 py-4">
                            {{-- LOGIKA WARNA (Sama seperti Peta) --}}
                            @php
                                $amenity = strtolower($rs->amenity);
                                $badgeClass = 'bg-blue-100 text-blue-800 border-blue-200'; // Default

                                if (Str::contains($amenity, ['rumah sakit', 'rs ', 'bersalin'])) {
                                    $badgeClass = 'bg-red-100 text-red-800 border-red-200';
                                } elseif (Str::contains($amenity, ['klinik'])) {
                                    $badgeClass = 'bg-green-100 text-green-800 border-green-200';
                                } elseif (Str::contains($amenity, ['puskesmas'])) {
                                    $badgeClass = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                }
                            @endphp

                            <span class="{{ $badgeClass }} px-2.5 py-1 rounded-full text-xs font-semibold border">
                                {{ $rs->amenity }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-folder-open text-4xl text-gray-300 mb-3"></i>
                                <p>Data rumah sakit tidak ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t bg-gray-50 flex flex-col sm:flex-row items-center justify-between gap-4">
            
            <div class="text-xs text-gray-500">
                Menampilkan <span class="font-bold">{{ $rumahsakit->firstItem() ?? 0 }}</span> - 
                <span class="font-bold">{{ $rumahsakit->lastItem() ?? 0 }}</span> dari 
                <span class="font-bold">{{ $rumahsakit->total() }}</span> data
            </div>

            <div class="flex gap-2">
                {{-- Tombol Sebelumnya --}}
                @if ($rumahsakit->onFirstPage())
                    <span class="px-3 py-1.5 rounded bg-gray-200 text-gray-400 text-xs cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $rumahsakit->previousPageUrl() }}" class="px-3 py-1.5 rounded bg-white border hover:bg-gray-100 text-gray-600 text-xs transition">Previous</a>
                @endif

                {{-- Tombol Selanjutnya --}}
                @if ($rumahsakit->hasMorePages())
                    <a href="{{ $rumahsakit->nextPageUrl() }}" class="px-3 py-1.5 rounded bg-white border hover:bg-gray-100 text-gray-600 text-xs transition">Next</a>
                @else
                    <span class="px-3 py-1.5 rounded bg-gray-200 text-gray-400 text-xs cursor-not-allowed">Next</span>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection