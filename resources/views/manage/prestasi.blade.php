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
                                <th class="py-2 px-3">Dibuat</th>
                                <th class="py-2 px-3">Judul</th>
                                <th class="py-2 px-3">Excerpt</th>
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
                                    <td class="py-2 px-3" x-text="ach.excerpt || '-'"></td>
                                    <td class="py-2 px-3" x-text="ach.rank"></td>
                                    <td class="py-2 px-3" x-text="ach.category?.name || '-'"></td>
                                    <td class="py-2 px-3">
                                        <template x-if="ach.image">
                                            <img :src="ach.image" alt="img"
                                                class="w-16 h-16 object-cover rounded">
                                        </template>
                                        <template x-if="!ach.image">
                                            <span class="text-gray-400">No Image</span>
                                        </template>
                                    </td>
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
                    @csrf
                    <div class="mb-3">
                        <label class="block mb-1">Judul Prestasi</label>
                        <input type="text" x-model="form.title" @input="generateSlug"
                            class="w-full rounded p-2 bg-gray-800 border border-gray-700">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Slug</label>
                        <input type="text" x-model="form.slug" readonly
                            class="w-full rounded p-2 bg-gray-700 border border-gray-600 text-gray-300 cursor-not-allowed">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Excerpt</label>
                        <input type="text" x-model="form.excerpt"
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
                        <input type="text" id="datepicker" x-model="form.date"
                            class="w-full rounded p-2 text-dark bg-gray-800 border border-gray-700 focus:ring focus:ring-green-500"
                            placeholder="Pilih tanggal" readonly>
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
                    slug: '',
                    excerpt: '',
                    description: '',
                    rank: '',
                    category_id: '',
                    date: '',
                    image: null,
                },

                async init() {
                    await this.loadAchievements();
                    await this.loadCategories();
                    const localeID = flatpickr.l10ns.id || flatpickr.l10ns.default;

                    flatpickr("#datepicker", {
                        dateFormat: "Y-m-d",
                        altInput: true,
                        altFormat: "d F Y",
                        locale: localeID,
                        disableMobile: true,
                        position: "above",
                    });
                },

                async loadAchievements() {
                    try {
                        const res = await fetch('/api/achievements');

                        if (!res.ok) {
                            throw new Error(`HTTP error! status: ${res.status}`);
                        }

                        const data = await res.json();

                        this.achievements = data.map(a => {
                            if (!a.image) {
                                a.image = '';
                            }
                            return a;
                        });
                    } catch (error) {
                        console.error('Gagal memuat prestasi:', error);
                        this.alertMessage = `Gagal memuat data: ${error.message}`;
                        this.alertType = 'error';
                        setTimeout(() => this.alertMessage = '', 5000);
                    }
                },

                async loadCategories() {
                    const res = await fetch('/api/categories');
                    const data = await res.json();
                    this.categories = data.categories || data;
                },

                openModal() {
                    this.resetForm();
                    this.showModal = true;
                },

                generateSlug() {
                    this.form.slug = this.form.title
                        .toLowerCase()
                        .trim()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/[\s-]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                },

                closeModal() {
                    this.showModal = false;
                    this.preview = '';
                },

                previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.compressImage(file).then(compressedFile => {
                            this.form.image = compressedFile;
                            this.preview = URL.createObjectURL(compressedFile);
                        }).catch(err => {
                            console.error('Gagal kompres gambar:', err);
                            this.alertMessage = 'Gagal mengompres gambar.';
                            this.alertType = 'error';
                            setTimeout(() => this.alertMessage = '', 4000);
                        });
                    }
                },

                async compressImage(file) {
                    const maxWidth = 800; // batas lebar maksimum (px)
                    const maxHeight = 800; // batas tinggi maksimum (px)
                    const quality = 0.6; // kualitas 0.0 - 1.0

                    return new Promise((resolve, reject) => {
                        const reader = new FileReader();
                        reader.readAsDataURL(file);

                        reader.onload = (event) => {
                            const img = new Image();
                            img.src = event.target.result;

                            img.onload = () => {
                                let width = img.width;
                                let height = img.height;

                                // ubah ukuran jika lebih besar dari batas
                                if (width > maxWidth || height > maxHeight) {
                                    if (width > height) {
                                        height = Math.round(height * (maxWidth / width));
                                        width = maxWidth;
                                    } else {
                                        width = Math.round(width * (maxHeight / height));
                                        height = maxHeight;
                                    }
                                }

                                // buat canvas
                                const canvas = document.createElement('canvas');
                                const ctx = canvas.getContext('2d');
                                canvas.width = width;
                                canvas.height = height;

                                ctx.drawImage(img, 0, 0, width, height);

                                // ubah ke blob terkompres
                                canvas.toBlob(
                                    (blob) => {
                                        if (!blob) return reject(new Error('Kompresi gagal.'));
                                        const compressedFile = new File([blob], file.name, {
                                            type: 'image/jpeg',
                                            lastModified: Date.now(),
                                        });
                                        resolve(compressedFile);
                                    },
                                    'image/jpeg',
                                    quality
                                );
                            };

                            img.onerror = () => reject(new Error('Gagal membaca gambar.'));
                        };

                        reader.onerror = () => reject(new Error('Gagal memuat file.'));
                    });
                },



                editAchievement(ach) {
                    const {
                        image,
                        ...rest
                    } = ach;
                    this.form = {
                        ...rest,
                    };
                    this.preview = ach.image || '';
                    this.showModal = true;
                },

                async saveAchievement() {
                    try {
                        const isEdit = !!this.form.id;
                        const formData = new FormData();

                        // Tambahkan semua field non-file
                        Object.entries(this.form).forEach(([key, value]) => {
                            if (key !== 'image' && key !== 'slug' && value !== null && value !== undefined &&
                                value !== '') {
                                formData.append(key, value);
                            }
                        });

                        // Validasi file gambar
                        if (this.form.image instanceof File) {
                            const maxSizeMB = 2;
                            const fileSizeMB = this.form.image.size / (1024 * 1024);
                            if (fileSizeMB > maxSizeMB) {
                                this.alertType = 'error';
                                this.alertMessage =
                                    `Ukuran file terlalu besar (${fileSizeMB.toFixed(2)} MB). Maksimal ${maxSizeMB} MB.`;
                                setTimeout(() => (this.alertMessage = ''), 4000);
                                return;
                            }
                            formData.append('image', this.form.image);
                        }

                        const url = isEdit ?
                            `/api/achievements/${this.form.id}?_method=PUT` :
                            '/api/achievements';

                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                        });

                        // Cek response
                        const data = await response.json().catch(() => ({}));

                        if (!response.ok) {
                            throw new Error(data.message || 'Gagal menyimpan data prestasi.');
                        }

                        // Sukses
                        this.alertType = 'success';
                        this.alertMessage = isEdit ?
                            'Prestasi berhasil diperbarui!' :
                            'Prestasi berhasil ditambahkan!';
                        this.showModal = false;

                        await this.loadAchievements();
                        setTimeout(() => (this.alertMessage = ''), 3000);
                    } catch (err) {
                        console.error('Error saving achievement:', err);
                        this.alertType = 'error';
                        this.alertMessage = err.message || 'Terjadi kesalahan, silakan coba lagi.';
                        setTimeout(() => (this.alertMessage = ''), 3000);
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
                        excerpt: '',
                        description: '',
                        rank: '',
                        category_id: '',
                        date: '',
                        image: null,
                    };
                    this.preview = '';
                }
            };
        }
    </script>
@endsection
