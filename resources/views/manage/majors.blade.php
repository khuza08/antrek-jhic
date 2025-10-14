@extends('layout')

@section('title', 'majors')

@section('content')
    <!-- Small Device Overlay -->
    <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
        class="fixed w-full h-screen z-9 bg-gray-900/50">
    </div>

    <!-- Main Content Start -->
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
        <h1 class="text-white text-2xl font-semibold mb-4">Manajemen Jurusan</h1>

        <!-- Kontainer tabel -->
        <div class="bg-gray-800 text-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar Jurusan</h2>
                <button class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Tambah Jurusan</button>
            </div>

            <table class="w-full text-left border-collapse">
                <thead class="border-b border-gray-600">
                    <tr>
                        <th class="py-2 px-3">#</th>
                        <th class="py-2 px-3">Nama Jurusan</th>
                        <th class="py-2 px-3">Deskripsi</th>
                        <th class="py-2 px-3">Tanggal Dibuat</th>
                        <th class="py-2 px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dummy Data -->
                    <tr class="border-b border-gray-700 hover:bg-gray-700">
                        <td class="py-2 px-3">1</td>
                        <td class="py-2 px-3">Sistem Informasi</td>
                        <td class="py-2 px-3">Update deskripsi</td>
                        <td class="py-2 px-3">2025-09-05 08:04:04</td>
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
