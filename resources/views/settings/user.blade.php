@extends('layout')

@section('title', 'User')

@section('content')
    <!-- Small Device Overlay -->
    <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
        class="fixed w-full h-screen z-9 bg-gray-900/50">
    </div>

    <!-- Main Content Start -->
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
        <h1 class="text-white text-2xl font-semibold mb-4">User Page</h1>

        <!-- Contoh konten tabel user -->
        <div class="bg-gray-800 text-white rounded-lg shadow p-4">
            <table class="w-full text-left">
                <thead class="border-b border-gray-600">
                    <tr>
                        <th class="py-2 px-3">#</th>
                        <th class="py-2 px-3">Nama</th>
                        <th class="py-2 px-3">Email</th>
                        <th class="py-2 px-3">Role</th>
                        <th class="py-2 px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-700 hover:bg-gray-700">
                        <td class="py-2 px-3">1</td>
                        <td class="py-2 px-3">Bayu</td>
                        <td class="py-2 px-3">bayu@example.com</td>
                        <td class="py-2 px-3">Admin</td>
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
