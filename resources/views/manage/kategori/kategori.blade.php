@extends('layout')

@section('title', 'Data Kategori')

@section('content')
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
        <h1 class="text-white text-2xl font-semibold mb-4">Manajemen Kategori</h1>

        <div class="bg-gray-800 text-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar Kategori</h2>
                <a href="{{ route('form-create-kategori') }}" class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Tambah
                    Kategori</a>
            </div>

            <table class="w-full text-left border-collapse">
                <thead class="border-b border-gray-600">
                    <tr>
                        <th class="py-2 px-3">No</th>
                        <th class="py-2 px-3">Nama</th>
                        <th class="py-2 px-3">Slug</th>
                        <th class="py-2 px-3">Deskripsi</th>
                        <th class="py-2 px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody id="categoryTableBody">
                    <tr>
                        <td colspan="6" class="text-center py-4">Memuat data...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
