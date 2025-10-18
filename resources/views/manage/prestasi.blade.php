@extends('layout')

@section('title', 'Manajemen Prestasi')

@section('content')
    <div x-data="achievementApp()" x-init="init()" class="p-4 mx-auto max-w-screen-2xl md:p-6">
        <h1 class="text-white text-2xl font-semibold mb-4">Manajemen Prestasi</h1>

        <!-- Container -->
        <div class="bg-gray-800 text-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar Prestasi</h2>
                <button @click="openModal()" class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Tambah
                    Prestasi</button>
            </div>

            <!-- Alert -->
            <template x-if="alertMessage">
                <div class="p-3 mb-4 rounded text-white" :class="alertType === 'success' ? 'bg-green-600' : 'bg-red-600'"
                    x-text="alertMessage"></div>
            </template>

            <!-- Table -->
            <div class="overflow-x-auto rounded-lg">
                <div class="w-full text-left border-collapse min-w-[600px]">
                    <table class="w-full text-left border-collapse">
                        <thead class="border-b border-gray-600">
                            <tr>
                                <th class="py-2 px-3">No</th>
                                <th class="py-2 px-3">Nama</th>
                                <th class="py-2 px-3">Judul</th>
                                <th class="py-2 px-3">Rank</th>
                                <th class="py-2 px-3">Gambar</th>
                                <th class="py-2 px-3">Kategori</th>
                                <th class="py-2 px-3">Tanggal</th>
                                <th class="py-2 px-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(ach, index) in achievements" :key="ach.id">
                                <tr class="border-b border-gray-700 hover:bg-gray-700">
                                    <td class="py-2 px-3" x-text="index + 1"></td>
                                    <td class="py-2 px-3" x-text="ach.user?.name || 'User 1'"></td>
                                    <td class="py-2 px-3" x-text="ach.title"></td>
                                    <td class="py-2 px-3" x-text="ach.rank"></td>
                                    <td class="py-2 px-3">
                                        <img :src="`/storage/${ach.image}`" alt="img"
                                            class="w-16 h-16 object-cover rounded" x-show="ach.image">
                                    </td>
                                    <td class="py-2 px-3" x-text="ach.category?.name || '-'"></td>
                                    <td class="py-2 px-3" x-text="ach.date"></td>
                                    <td class="py-2 px-3 space-x-2">
                                        <button @click="editAchievement(ach)"
                                            class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-500">Edit</button>
                                        <button @click="deleteAchievement(ach.id)"
                                            class="bg-red-600 px-3 py-1 rounded hover:bg-red-500">Hapus</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="showModal" class="fixed inset-0 bg-black/60 z-50 flex justify-center items-start overflow-y-auto p-4">
            <div class="bg-gray-900 p-6 rounded-lg w-full max-w-lg text-white max-h-[90vh] overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4" x-text="form.id ? 'Edit Prestasi' : 'Tambah Prestasi'"></h2>

                <form @submit.prevent="saveAchievement">
                    <div class="mb-3">
                        <label class="block mb-1">Judul Prestasi</label>
                        <input type="text" x-model="form.title"
                            class="w-full rounded p-2 bg-gray-800 border border-gray-700">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Deskripsi</label>
                        <textarea x-model="form.description" class="w-full rounded p-2 bg-gray-800 border border-gray-700"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Rank</label>
                        <input type="text" x-model="form.rank"
                            class="w-full rounded p-2 bg-gray-800 border border-gray-700">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Kategori</label>
                        <select x-model="form.category_id" class="w-full rounded p-2 bg-gray-800 border border-gray-700">
                            <option value="">Pilih Kategori</option>
                            <template x-for="cat in categories" :key="cat.id">
                                <option :value="cat.id" x-text="cat.name"></option>
                            </template>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Tanggal</label>
                        <input type="date" x-model="form.date"
                            class="w-full rounded p-2 bg-gray-800 border border-gray-700">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Gambar</label>
                        <input type="file" @change="previewImage" class="w-full text-gray-300">
                        <template x-if="preview">
                            <img :src="preview" class="w-32 h-32 object-cover mt-2 rounded">
                        </template>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="closeModal"
                            class="bg-gray-600 px-3 py-1 rounded hover:bg-gray-500">Batal</button>
                        <button type="submit" class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Simpan</button>
                    </div>
                </form>
            </div>
        </div>


    </div>

    <script>
        function achievementApp() {
            return {
                achievements: [],
                categories: [],
                showModal: false,
                alertMessage: '',
                alertType: 'success',
                preview: '',
                form: {
                    id: null,
                    title: '',
                    description: '',
                    rank: '',
                    category_id: '',
                    date: '',
                    image: null,
                    user_id: 1,
                },

                async init() {
                    await this.loadAchievements();
                    await this.loadCategories();
                },

                async loadAchievements() {
                    const res = await fetch('/api/achievements');
                    this.achievements = await res.json();
                },

                async loadCategories() {
                    const res = await fetch('/api/categories');
                    const data = await res.json();
                    this.categories = data.categories || data; // ✅ fix di sini
                },

                openModal() {
                    this.resetForm();
                    this.showModal = true;
                },

                closeModal() {
                    this.showModal = false;
                    this.preview = '';
                },

                previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.form.image = file;
                        this.preview = URL.createObjectURL(file);
                    }
                },

                editAchievement(ach) {
                    this.form = {
                        ...ach,
                        user_id: 1
                    };
                    this.preview = ach.image ? `/storage/${ach.image}` : '';
                    this.showModal = true;
                },

                async saveAchievement() {
                    try {
                        const formData = new FormData();
                        for (const key in this.form) {
                            if (this.form[key]) formData.append(key, this.form[key]);
                        }

                        const method = this.form.id ? 'POST' : 'POST';
                        const url = this.form.id ? `/api/achievements/${this.form.id}?_method=PUT` :
                            '/api/achievements';

                        const res = await fetch(url, {
                            method,
                            body: formData
                        });
                        if (!res.ok) throw await res.json();

                        this.alertMessage = this.form.id ? 'Prestasi berhasil diperbarui!' :
                            'Prestasi berhasil ditambahkan!';
                        this.alertType = 'success';
                        this.showModal = false;
                        this.loadAchievements();
                        setTimeout(() => this.alertMessage = '', 3000);
                    } catch (e) {
                        this.alertMessage = 'Terjadi kesalahan, silakan coba lagi.';
                        this.alertType = 'error';
                        setTimeout(() => this.alertMessage = '', 3000);
                    }
                },

                async deleteAchievement(id) {
                    if (!confirm('Yakin ingin menghapus prestasi ini?')) return;
                    const res = await fetch(`/api/achievements/${id}`, {
                        method: 'DELETE'
                    });
                    if (res.ok) {
                        this.alertMessage = 'Prestasi berhasil dihapus!';
                        this.alertType = 'success';
                        this.loadAchievements();
                    } else {
                        this.alertMessage = 'Gagal menghapus prestasi.';
                        this.alertType = 'error';
                    }
                    setTimeout(() => this.alertMessage = '', 3000);
                },

                resetForm() {
                    this.form = {
                        id: null,
                        title: '',
                        description: '',
                        rank: '',
                        category_id: '',
                        date: '',
                        image: null,
                        user_id: 1
                    };
                    this.preview = '';
                }
            };
        }
    </script>
@endsection
