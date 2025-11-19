@extends('layouts.app') {{-- ganti sesuai layout kamu --}}

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Daftar Lokasi Rumah Sakit</h2>

    <div class="bg-white shadow rounded p-4">
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border px-3 py-2">No</th>
                    <th class="border px-3 py-2">Nama Rumah Sakit</th>
                    <th class="border px-3 py-2">Alamat</th>
                    <th class="border px-3 py-2">Telepon</th>
                    <th class="border px-3 py-2">Latitude</th>
                    <th class="border px-3 py-2">Longitude</th>
                    <th class="border px-3 py-2">Gambar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $rs)
                <tr>
                    <td class="border px-3 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-3 py-2">{{ $rs->nama_rs }}</td>
                    <td class="border px-3 py-2">{{ $rs->alamat }}</td>
                    <td class="border px-3 py-2">{{ $rs->telepon }}</td>
                    <td class="border px-3 py-2">{{ $rs->latitude }}</td>
                    <td class="border px-3 py-2">{{ $rs->longitude }}</td>
                    <td class="border px-3 py-2">
                        @if($rs->gambar)
                            <img src="{{ asset('storage/rs/'.$rs->gambar) }}" class="h-16 rounded">
                        @else
                            <span class="text-gray-500">Tidak ada</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
