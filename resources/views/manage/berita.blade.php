@extends('layout')

@section('title', 'Berita')

@section('content')
    <!-- Small Device Overlay -->
    <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
        class="fixed w-full h-screen z-9 bg-gray-900/50">
    </div>

    <!-- Main Content Start -->
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
        <h1 class="text-white text-2xl font-semibold mb-4">Manajemen Berita</h1>

        <!-- Kontainer tabel -->
        <div class="bg-gray-800 text-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar Berita</h2>
                <button class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Tambah Berita</button>
            </div>

            <table class="w-full text-left border-collapse">
                <thead class="border-b border-gray-600">
                    <tr>
                        <th class="py-2 px-3">#</th>
                        <th class="py-2 px-3">Judul</th>
                        <th class="py-2 px-3">Kategori</th>
                        <th class="py-2 px-3">Penulis</th>
                        <th class="py-2 px-3">Excerpt</th>
                        <th class="py-2 px-3">Content</th>
                        <th class="py-2 px-3">Gambar</th>
                        <th class="py-2 px-3">Dibuat</th>
                        <th class="py-2 px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dummy Data -->
                    <tr class="border-b border-gray-700 hover:bg-gray-700">
                        <td class="py-2 px-3">1</td>
                        <td class="py-2 px-3">Kegiatan Sekolah 2025</td>
                        <td class="py-2 px-3">Informasi</td>
                        <td class="py-2 px-3">Admin</td>
                        <td class="py-2 px-3">Pembukaan tahun ajaran baru...</td>
                        <td class="py-2 px-3">Pembukaan awal pendaftaran ajaran baru untuk sekolah antrek</td>
                        <td class="py-2 px-3">
                            <img src="/images/news1.jpg" class="w-12 h-12 rounded object-cover" alt="thumbnail">
                        </td>
                        <td class="py-2 px-3">2025-10-14</td>
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
