@extends('layout')

@section('title', 'Form Create Kategori')

@section('content')
    <form class="max-w-sm">
        <div class="mb-5">
            <label for="nama-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
            <input type="text" id="nama-input"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="nama" placeholder="Masukan nama kategori">
        </div>
        <div class="mb-5">
            <label for="slug-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
            <input type="text" id="slug-input"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="slug" readonly placeholder="Slug kategori otomatis">
        </div>
        <div class="mb-5">
            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
            <textarea id="deskripsi" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukan deskripsi kategori" name="deskripsi"></textarea>
        </div>
        <button type="button"
            class="px-8 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
@endsection
