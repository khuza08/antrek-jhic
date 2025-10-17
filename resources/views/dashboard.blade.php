@extends('layout')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- Overlay untuk layar kecil -->
    <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
        class="fixed w-full h-screen z-9 bg-gray-900/50">
    </div>

    <!-- Main Content -->
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
        <h1 class="text-white text-2xl font-semibold mb-6">Dashboard Admin</h1>

        <!-- Statistik ringkas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-gray-800 rounded-xl p-4 shadow hover:bg-gray-700 transition">
                <h2 class="text-gray-400 text-sm mb-1">Total Pengguna</h2>
                <p class="text-2xl font-bold text-white">120</p>
            </div>
            <div class="bg-gray-800 rounded-xl p-4 shadow hover:bg-gray-700 transition">
                <h2 class="text-gray-400 text-sm mb-1">Total Guru</h2>
                <p class="text-2xl font-bold text-white">15</p>
            </div>
            <div class="bg-gray-800 rounded-xl p-4 shadow hover:bg-gray-700 transition">
                <h2 class="text-gray-400 text-sm mb-1">Total Jurusan</h2>
                <p class="text-2xl font-bold text-white">5</p>
            </div>
            <div class="bg-gray-800 rounded-xl p-4 shadow hover:bg-gray-700 transition">
                <h2 class="text-gray-400 text-sm mb-1">Total Berita</h2>
                <p class="text-2xl font-bold text-white">8</p>
            </div>
        </div>

        <!-- Tabel data terbaru -->
        <div class="bg-gray-800 text-white rounded-lg shadow p-4 mb-20 sm:mb-8">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 gap-2">
                <h2 class="text-lg font-semibold text-center sm:text-left">Aktivitas Terbaru</h2>
                <button class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-500 w-full sm:w-auto">Lihat Semua</button>
            </div>

            <!-- Tambah scroll horizontal di mobile -->
            <div class="overflow-x-auto">
                <table class="w-full min-w-[500px] text-left border-collapse">
                    <thead class="border-b border-gray-600">
                        <tr>
                            <th class="py-2 px-3">No</th>
                            <th class="py-2 px-3">Nama Aktivitas</th>
                            <th class="py-2 px-3">Kategori</th>
                            <th class="py-2 px-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-700 hover:bg-gray-700">
                            <td class="py-2 px-3">1</td>
                            <td class="py-2 px-3">Tambah Guru Baru</td>
                            <td class="py-2 px-3">Guru</td>
                            <td class="py-2 px-3">2025-10-14</td>
                        </tr>
                        <tr class="border-b border-gray-700 hover:bg-gray-700">
                            <td class="py-2 px-3">2</td>
                            <td class="py-2 px-3">Edit Data Jurusan</td>
                            <td class="py-2 px-3">Majors</td>
                            <td class="py-2 px-3">2025-10-13</td>
                        </tr>
                        <tr class="border-b border-gray-700 hover:bg-gray-700">
                            <td class="py-2 px-3">3</td>
                            <td class="py-2 px-3">Tambah Prestasi Baru</td>
                            <td class="py-2 px-3">Achievements</td>
                            <td class="py-2 px-3">2025-10-12</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
