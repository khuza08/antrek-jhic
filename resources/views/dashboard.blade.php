@extends('layout')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
        <h1 class="text-white text-2xl font-semibold mb-6">Dashboard Admin</h1>

        <!-- Statistik dari database -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-gray-800 rounded-xl p-4 shadow hover:bg-gray-700 transition">
                <h2 class="text-gray-400 text-sm mb-1">Total Pengguna</h2>
                <p class="text-2xl font-bold text-white">{{ $totalUsers }}</p>
            </div>
            <div class="bg-gray-800 rounded-xl p-4 shadow hover:bg-gray-700 transition">
                <h2 class="text-gray-400 text-sm mb-1">Total Guru</h2>
                <p class="text-2xl font-bold text-white">{{ $totalTeachers }}</p>
            </div>
            <div class="bg-gray-800 rounded-xl p-4 shadow hover:bg-gray-700 transition">
                <h2 class="text-gray-400 text-sm mb-1">Total Jurusan</h2>
                <p class="text-2xl font-bold text-white">{{ $totalMajors }}</p>
            </div>
            <div class="bg-gray-800 rounded-xl p-4 shadow hover:bg-gray-700 transition">
                <h2 class="text-gray-400 text-sm mb-1">Total Berita</h2>
                <p class="text-2xl font-bold text-white">{{ $totalNews }}</p>
            </div>
        </div>

        <!-- Tabel aktivitas -->
        <div class="bg-gray-800 text-white rounded-lg shadow p-4 mb-20 sm:mb-8">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 gap-2">
                <h2 class="text-lg font-semibold text-center sm:text-left">Aktivitas Terbaru</h2>
            </div>

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
                        @foreach ($activities as $index => $activity)
                            <tr class="border-b border-gray-700 hover:bg-gray-700">
                                <td class="py-2 px-3">{{ $index + 1 }}</td>
                                <td class="py-2 px-3">{{ $activity['name'] }}</td>
                                <td class="py-2 px-3">{{ $activity['category'] }}</td>
                                <td class="py-2 px-3">{{ \Carbon\Carbon::parse($activity['date'])->format('Y-m-d H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
