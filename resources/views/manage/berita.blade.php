@extends('layout')

@section('title', 'Manajemen Berita')

@section('content')
    <div x-data="newsApp()" x-init="loadNews();
    initTrix()" class="p-4 mx-auto max-w-screen-2xl md:p-6 text-white">
        <h1 class="text-2xl font-semibold mb-4">Manajemen Berita</h1>

        <template x-if="alert.show">
            <div x-text="alert.message"
                :class="alert.type === 'success' ? 'bg-green-600 text-white p-3 rounded mb-4' :
                    'bg-red-600 text-white p-3 rounded mb-4'"
                x-transition></div>
        </template>

        <div class="bg-gray-800 rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar Berita</h2>
                <button @click="openModal()" class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Tambah
                    Berita</button>
            </div>

            <div class="overflow-x-auto rounded-lg">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead class="border-b border-gray-600">
                        <tr>
                            <th class="py-2 px-3">No</th>
                            <th class="py-2 px-3">Judul</th>
                            <th class="py-2 px-3">Slug</th>
                            <th class="py-2 px-3">Kategori</th>
                            <th class="py-2 px-3">Excerpt</th>
                            <th class="py-2 px-3">Gambar</th>
                            <th class="py-2 px-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-if="news.length === 0">
                            <tr>
                                <td colspan="7" class="text-center py-4">Belum ada data</td>
                            </tr>
                        </template>
                        <template x-for="(item, index) in news" :key="item.id">
                            <tr class="border-b border-gray-700 hover:bg-gray-700">
                                <td class="py-2 px-3" x-text="index + 1"></td>
                                <td class="py-2 px-3" x-text="item.title"></td>
                                <td class="py-2 px-3" x-text="item.slug"></td>
                                <td class="py-2 px-3" x-text="item.category ? item.category.name : '-'"></td>
                                <td class="py-2 px-3" x-text="item.excerpt"></td>
                                <td class="py-2 px-3">
                                    <template x-if="item.image">
                                        <img :src="item.image" class="w-12 h-12 rounded object-cover cursor-pointer"
                                            @click="viewImage(item.image)" alt="Preview">
                                    </template>
                                    <template x-if="!item.image">
                                        <span class="text-gray-500">-</span>
                                    </template>
                                </td>
                                <td class="py-2 px-3 flex gap-2">
                                    <button @click="editNews(item)"
                                        class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-500">Edit</button>
                                    <button @click="deleteNews(item.id)"
                                        class="bg-red-600 px-3 py-1 rounded hover:bg-red-500">Hapus</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Form -->
        <div x-show="showModal"
            class="fixed inset-0 bg-black bg-opacity-60 z-50 flex justify-center items-start overflow-y-auto p-4"
            x-transition>
            <div class="bg-gray-900 p-6 rounded-lg w-full max-w-lg text-white mt-8">
                <h2 class="text-xl font-semibold mb-4" x-text="form.id ? 'Edit Berita' : 'Tambah Berita'"></h2>

                <form @submit.prevent="saveNews">
                    @csrf
                    <div class="mb-3">
                        <label class="block mb-1">Judul</label>
                        <input type="text" x-model="form.title" @input="generateSlug"
                            class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 text-white" required>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Slug</label>
                        <input type="text" x-model="form.slug" readonly
                            class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-700 text-gray-400">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Kategori</label>
                        <select x-model="form.category_id"
                            class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 text-white" required>
                            <option value="">Pilih Kategori</option>
                            <template x-for="cat in categories" :key="cat.id">
                                <option :value="cat.id" x-text="cat.name"></option>
                            </template>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Excerpt</label>
                        <textarea x-model="form.excerpt" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 text-white"
                            required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Konten</label>
                        <input id="trix-content" type="hidden" name="content" x-model="form.content">
                        <trix-editor input="trix-content"
                            class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 text-white min-h-[200px]"></trix-editor>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Gambar</label>
                        <input type="file" @change="handleImageUpload" accept="image/*"
                            class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 text-white">
                        <template x-if="imagePreview">
                            <div class="mt-2 text-sm text-gray-400">
                                <img :src="imagePreview" class="w-32 h-32 object-cover rounded" alt="Preview">
                                <p class="mt-2">Size: <span x-text="formatFileSize(imagePreview.length)"></span></p>
                            </div>
                        </template>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="closeModal()"
                            class="bg-gray-600 px-4 py-2 rounded hover:bg-gray-500">Batal</button>
                        <button type="submit" class="bg-green-600 px-4 py-2 rounded hover:bg-green-500">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function newsApp() {
            return {
                news: [],
                categories: [],
                showModal: false,
                imagePreview: null,
                imageBase64: null, // Simpan base64 terpisah
                alert: {
                    show: false,
                    message: '',
                    type: 'success'
                },
                form: {
                    id: null,
                    title: '',
                    slug: '',
                    category_id: '',
                    excerpt: '',
                    content: '',
                    user_id: 1 // Default user_id
                },

                formatFileSize(bytes) {
                    return (bytes / 1024).toFixed(2) + ' KB';
                },

                generateSlug() {
                    if (!this.form.title) {
                        this.form.slug = '';
                        return;
                    }
                    this.form.slug = this.form.title
                        .toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .trim()
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                },

                async loadNews() {
                    try {
                        const res = await fetch('/api/news');
                        if (!res.ok) throw new Error(`HTTP ${res.status}`);

                        const data = await res.json();
                        this.news = data;
                        console.log('News loaded:', data.length, 'items');

                        const catRes = await fetch('/api/categories');
                        const catData = await catRes.json();
                        this.categories = catData.categories || catData;
                        console.log('Categories loaded:', this.categories.length, 'items');
                    } catch (e) {
                        console.error('Error loading news:', e);
                        this.showAlert('Gagal memuat data berita!', 'error');
                    }
                },

                initTrix() {
                    setTimeout(() => {
                        if (typeof Trix === 'undefined') {
                            console.log('Trix not loaded yet, retrying...');
                            this.initTrix();
                            return;
                        }
                        const trixEditor = document.querySelector('trix-editor');
                        if (!trixEditor) {
                            console.log('Trix editor element not found, retrying...');
                            this.initTrix();
                            return;
                        }
                        const hiddenInput = document.getElementById('trix-content');
                        if (hiddenInput) {
                            trixEditor.addEventListener('trix-change', () => {
                                this.form.content = trixEditor.editor.getDocument().toString();
                            });
                            this.form.content = hiddenInput.value;
                            console.log('Trix initialized successfully');
                        }
                    }, 500);
                },

                async handleImageUpload(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    if (!file.type.startsWith('image/')) {
                        this.showAlert('File harus berupa gambar!', 'error');
                        event.target.value = '';
                        return;
                    }

                    const maxSize = 5 * 1024 * 1024;
                    if (file.size > maxSize) {
                        this.showAlert('File terlalu besar! Maksimal 5MB', 'error');
                        event.target.value = '';
                        return;
                    }

                    // 🔽 Kompres gambar terlebih dahulu
                    const compressedFile = await this.compressImage(file, 0.1); // ubah 0.6 → 0.4 jika mau lebih kecil

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageBase64 = e.target.result;
                        this.imagePreview = e.target.result;
                    };
                    reader.readAsDataURL(compressedFile);
                },

                async compressImage(file, quality = 0.6) {
                    return new Promise((resolve) => {
                        const reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = (event) => {
                            const img = new Image();
                            img.src = event.target.result;
                            img.onload = () => {
                                const canvas = document.createElement('canvas');
                                const ctx = canvas.getContext('2d');

                                const MAX_WIDTH = 800;
                                const scale = Math.min(1, MAX_WIDTH / img.width);
                                const width = img.width * scale;
                                const height = img.height * scale;

                                canvas.width = width;
                                canvas.height = height;
                                ctx.drawImage(img, 0, 0, width, height);

                                canvas.toBlob(
                                    (blob) => {
                                        resolve(
                                            new File([blob], file.name, {
                                                type: 'image/jpeg',
                                                lastModified: Date.now()
                                            })
                                        );
                                    },
                                    'image/jpeg',
                                    quality
                                );
                            };
                        };
                    });
                },

                showAlert(message, type) {
                    this.alert = {
                        show: true,
                        message: message,
                        type: type || 'success'
                    };
                    setTimeout(() => {
                        this.alert.show = false;
                    }, 3000);
                },

                openModal() {
                    this.resetForm();
                    this.showModal = true;
                },

                closeModal() {
                    this.showModal = false;
                    this.imagePreview = null;
                    this.imageBase64 = null;
                },

                resetForm() {
                    this.form = {
                        id: null,
                        title: '',
                        slug: '',
                        category_id: '',
                        excerpt: '',
                        content: '',
                        user_id: 1
                    };
                    this.imagePreview = null;
                    this.imageBase64 = null;

                    const trixEditor = document.querySelector('trix-editor');
                    if (trixEditor && trixEditor.editor) {
                        trixEditor.editor.loadHTML('');
                    }
                },

                editNews(item) {
                    this.form = {
                        id: item.id,
                        title: item.title,
                        slug: item.slug,
                        category_id: item.category_id,
                        excerpt: item.excerpt,
                        content: item.content,
                        user_id: item.user_id || 1
                    };

                    const trixEditor = document.querySelector('trix-editor');
                    if (trixEditor && trixEditor.editor) {
                        trixEditor.editor.loadHTML(item.content || '');
                    }

                    if (item.image) {
                        this.imagePreview = item.image;
                        this.imageBase64 = item.image; // Gunakan image yang sudah ada
                        console.log('Edit mode - image preview set');
                    }

                    this.showModal = true;
                },

                viewImage(imageBase64) {
                    window.open(imageBase64, '_blank');
                },

                async saveNews() {
                    // Validasi client-side
                    if (!this.form.title || !this.form.excerpt || !this.form.content) {
                        this.showAlert('Judul, Excerpt, dan Konten wajib diisi!', 'error');
                        return;
                    }

                    if (!this.form.category_id) {
                        this.showAlert('Kategori wajib dipilih!', 'error');
                        return;
                    }

                    const isEdit = !!this.form.id;
                    const url = isEdit ? `/api/news/${this.form.id}` : '/api/news';
                    const method = isEdit ? 'PUT' : 'POST';

                    // Siapkan data JSON
                    const payload = {
                        user_id: parseInt(this.form.user_id) || 1,
                        category_id: parseInt(this.form.category_id),
                        title: this.form.title,
                        excerpt: this.form.excerpt,
                        content: this.form.content
                    };

                    // Tambahkan image jika ada (base64 string)
                    if (this.imageBase64) {
                        payload.image = this.imageBase64;
                    }

                    console.log('Sending payload:', {
                        ...payload,
                        image: payload.image ?
                            `[Base64 string: ${payload.image.substring(0, 50)}... (${payload.image.length} chars)]` :
                            null
                    });

                    try {
                        const res = await fetch(url, {
                            method: method,
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(payload)
                        });

                        const data = await res.json();

                        if (!res.ok) {
                            console.error('Server response error:', data);

                            // Tampilkan error validasi detail
                            if (data.errors) {
                                const errorMessages = Object.entries(data.errors)
                                    .map(([field, messages]) => `${field}: ${messages.join(', ')}`)
                                    .join('\n');
                                this.showAlert('Validasi gagal:\n' + errorMessages, 'error');
                            } else {
                                this.showAlert(data.message || 'Gagal menyimpan data!', 'error');
                            }
                            return;
                        }

                        console.log('Save success:', data);
                        await this.loadNews();
                        this.closeModal();
                        this.showAlert(isEdit ? 'Berita berhasil diperbarui!' : 'Berita berhasil ditambahkan!');

                    } catch (err) {
                        console.error('Request error:', err);
                        this.showAlert('Terjadi kesalahan: ' + err.message, 'error');
                    }
                },

                async deleteNews(id) {
                    if (!confirm('Hapus berita ini?')) return;

                    try {
                        const res = await fetch(`/api/news/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json'
                            }
                        });

                        if (res.ok) {
                            await this.loadNews();
                            this.showAlert('Berita berhasil dihapus!');
                        } else {
                            const data = await res.json();
                            this.showAlert(data.message || 'Gagal menghapus berita!', 'error');
                        }
                    } catch (err) {
                        console.error('Delete error:', err);
                        this.showAlert('Gagal menghapus berita!', 'error');
                    }
                }
            };
        }
    </script>
@endsection
