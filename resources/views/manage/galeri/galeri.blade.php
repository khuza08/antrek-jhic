@extends('layout')

@section('title', 'Data Galeri')

@section('content')
    <!-- Small Device Overlay -->
    <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
        class="fixed w-full h-screen z-9 bg-gray-900/50">
    </div>

    <!-- Main Content Start -->
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
        <h1 class="text-white text-2xl font-semibold mb-4">Manajemen Galeri</h1>

        <!-- Kontainer tabel -->
        <div class="bg-gray-800 text-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar Galeri</h2>
                <button class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Tambah Gambar</button>
            </div>

            <table class="w-full text-left border-collapse">
                <thead class="border-b border-gray-600">
                    <tr>
                        <th class="py-2 px-3">#</th>
                        <th class="py-2 px-3">Judul</th>
                        <th class="py-2 px-3">Kategori</th>
                        <th class="py-2 px-3">User ID</th>
                        <th class="py-2 px-3">Gambar</th>
                        <th class="py-2 px-3">Tanggal Dibuat</th>
                        <th class="py-2 px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dummy Data -->
                    <tr class="border-b border-gray-700 hover:bg-gray-700">
                        <td class="py-2 px-3">1</td>
                        <td class="py-2 px-3">Kegiatan Workshop IT</td>
                        <td class="py-2 px-3">Kampus</td>
                        <td class="py-2 px-3">2</td>
                        <td class="py-2 px-3">
                            <img src="https://via.placeholder.com/80" alt="gambar1"
                                class="rounded-lg w-20 h-12 object-cover">
                        </td>
                        <td class="py-2 px-3">2025-10-14 09:00:00</td>
                        <td class="py-2 px-3">
                            <button class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-500">Edit</button>
                            <button class="bg-red-600 px-3 py-1 rounded hover:bg-red-500">Hapus</button>
                        </td>
                    </tr>

                    <tr class="border-b border-gray-700 hover:bg-gray-700">
                        <td class="py-2 px-3">2</td>
                        <td class="py-2 px-3">Kunjungan Industri</td>
                        <td class="py-2 px-3">Sekolah</td>
                        <td class="py-2 px-3">3</td>
                        <td class="py-2 px-3">
                            <img src="https://via.placeholder.com/80" alt="gambar2"
                                class="rounded-lg w-20 h-12 object-cover">
                        </td>
                        <td class="py-2 px-3">2025-10-13 15:22:10</td>
                        <td class="py-2 px-3">
                            <button class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-500">Edit</button>
                            <button class="bg-red-600 px-3 py-1 rounded hover:bg-red-500">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
