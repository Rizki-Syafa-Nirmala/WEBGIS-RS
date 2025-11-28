@extends('layout.app')

@section('content')
<div class="p-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Lokasi Rumah Sakit</h2>
            <p class="text-sm text-gray-500">Data rumah sakit yang terdaftar dalam sistem</p>
        </div>

        <a href="{{ route('peta') }}"
           class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow">
            <i class="fas fa-map-marked-alt"></i>
            Lihat Peta
        </a>
    </div>

    <!-- CARD TABLE -->
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Rumah Sakit</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Amenity</th>
                    </tr>
                </thead>
                <tbody class="divide-y">

                    @forelse($rumahsakit as $index => $rs)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-4 py-3 font-medium text-gray-700">
                            {{ $rumahsakit->firstItem() + $index }}
                        </td>
                        <td class="px-4 py-3 font-semibold text-blue-600">
                            {{ $rs->nama_rs }}
                        </td>
                        <td class="px-4 py-3 text-gray-600">
                            {{ $rs->alamat }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                {{ $rs->amenity }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-gray-500">
                            Data rumah sakit belum tersedia.
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="px-6 py-6 border-t bg-white flex flex-col items-center gap-3">

            <!-- Tombol Sebelumnya & Selanjutnya -->
            <div class="flex gap-3">

                {{-- Tombol Sebelumnya --}}
                @if ($rumahsakit->onFirstPage())
                    <span class="px-4 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">
                        ← Sebelumnya
                    </span>
                @else
                    <a href="{{ $rumahsakit->previousPageUrl() }}"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                        ← Sebelumnya
                    </a>
                @endif


                {{-- Tombol Selanjutnya --}}
                @if ($rumahsakit->hasMorePages())
                    <a href="{{ $rumahsakit->nextPageUrl() }}"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                        Selanjutnya →
                    </a>
                @else
                    <span class="px-4 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">
                        Selanjutnya →
                    </span>
                @endif

            </div>

            <!-- Showing Result di Bawah -->
            <div class="text-sm text-gray-500">
                Menampilkan 
                <span class="font-semibold">{{ $rumahsakit->firstItem() }}</span>
                –
                <span class="font-semibold">{{ $rumahsakit->lastItem() }}</span>
                dari
                <span class="font-semibold">{{ $rumahsakit->total() }}</span>
                data
            </div>

        </div>





    </div>

</div>
@endsection
