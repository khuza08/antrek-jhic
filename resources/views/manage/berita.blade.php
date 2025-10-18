@extends('layout')

@section('title', 'Manajemen Berita')

@section('content')
    <div x-data="newsApp()" x-init="loadNews()" class="p-4 mx-auto max-w-screen-2xl md:p-6 text-white">
        <h1 class="text-2xl font-semibold mb-4">Manajemen Berita</h1>
        <template x-if="alert.show">
            <div x-text="alert.message"
                :class="alert.type === 'success' ?
                    'bg-green-600 text-white p-3 rounded mb-4' :
                    'bg-red-600 text-white p-3 rounded mb-4'"
                x-transition>
            </div>
        </template>

        <div class="bg-gray-800 rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar Berita</h2>
                <button @click="openModal()" class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Tambah
                    Berita</button>
            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto rounded-lg">
                <div class="w-full text-left border-collapse min-w-[600px]">
                    <table class="w-full text-left border-collapse">
                        <thead class="border-b border-gray-600">
                            <tr>
                                <th class="py-2 px-3">No</th>
                                <th class="py-2 px-3">Judul</th>
                                <th class="py-2 px-3">Slug</th>
                                <th class="py-2 px-3">Kategori</th>
                                <th class="py-2 px-3">Excerpt</th>
                                <th class="py-2 px-3">Content</th>
                                <th class="py-2 px-3">Gambar</th>
                                <th class="py-2 px-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-if="news.length === 0">
                                <tr>
                                    <td colspan="12" class="text-center py-4">Belum ada data</td>
                                </tr>
                            </template>
                            <template x-for="(item, index) in news" :key="item.id">
                                <tr class="border-b border-gray-700 hover:bg-gray-700">
                                    <td class="py-2 px-3" x-text="index + 1"></td>
                                    <td class="py-2 px-3" x-text="item.title"></td>
                                    <td class="py-2 px-3" x-text="item.slug"></td>
                                    <td class="py-2 px-3" x-text="item.category?.name ?? '-'"></td>
                                    <td class="py-2 px-3" x-text="item.excerpt"></td>
                                    <td class="py-2 px-3" x-text="item.content"></td>
                                    <td class="py-2 px-3">
                                        <img :src="'/storage/' + item.image" class="w-12 h-12 rounded object-cover"
                                            alt="">
                                    </td>
                                    <td class="py-2 px-3">
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
        </div>

        <!-- Modal -->
        <div x-show="showModal"
            class="fixed inset-0 bg-black/60 z-50 flex justify-center items-start overflow-y-auto p-4 z-40" x-transition>
            <div class="bg-gray-900 p-6 rounded-lg w-full max-w-lg text-white max-h-[90vh] overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4" x-text="form.id ? 'Edit Berita' : 'Tambah Berita'"></h2>

                <form @submit.prevent="saveNews">
                    <div class="mb-3">
                        <label class="block mb-1">Judul</label>
                        <input type="text" x-model="form.title" @input="generateSlug"
                            class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 text-white">
                    </div>
                    <!-- Input Slug (readonly) -->
                    <div class="mb-3">
                        <label class="block mb-1">Slug</label>
                        <input type="text" x-model="form.slug" readonly
                            class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 text-white cursor-not-allowed">
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1">Kategori</label>
                        <select x-model="form.category_id"
                            class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 text-white">
                            <option value="">Pilih Kategori</option>
                            <template x-for="(cat, i) in categories" :key="cat.id ?? i">
                                <option :value="cat.id" x-text="cat.name"></option>
                            </template>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1">Excerpt</label>
                        <textarea x-model="form.excerpt" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 text-white"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1">Content</label>
                        <input id="trix-content" type="hidden" name="content" x-model="form.content">
                        <trix-editor input="trix-content"
                            class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 text-white min-h-[200px]">
                        </trix-editor>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1">Gambar</label>
                        <input type="file" @change="form.image = $event.target.files[0]"
                            class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700 text-white">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="closeModal()"
                            class="bg-gray-600 px-3 py-1 rounded hover:bg-gray-500">Batal</button>
                        <button type="submit" class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Simpan</button>
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
                alert: {
                    show: false,
                    message: '',
                    type: 'success' // success | error
                },
                // Di dalam return { ... }
                generateSlug() {
                    if (!this.form.title) {
                        this.form.slug = '';
                        return;
                    }
                    const slug = this.form.title
                        .toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .trim()
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                    this.form.slug = slug;
                },
                form: {
                    id: null,
                    title: '',
                    category_id: '',
                    excerpt: '',
                    content: '',
                    image: null
                },

                async loadNews() {
                    try {
                        const res = await fetch('/api/news');
                        this.news = await res.json();

                        const cat = await fetch('/api/categories');
                        const catData = await cat.json();
                        this.categories = catData.categories || catData;
                    } catch (e) {
                        console.error(e);
                    }
                },

                showAlert(message, type = 'success') {
                    this.alert = {
                        show: true,
                        message,
                        type
                    };
                    setTimeout(() => this.alert.show = false, 3000);
                },

                openModal() {
                    this.resetForm();
                    this.showModal = true;
                },

                closeModal() {
                    this.showModal = false;
                },

                resetForm() {
                    this.form = {
                        id: null,
                        title: '',
                        category_id: '',
                        excerpt: '',
                        content: '',
                        image: null
                    };
                },

                editNews(item) {
                    this.form = {
                        id: item.id,
                        title: item.title,
                        category_id: item.category_id,
                        excerpt: item.excerpt,
                        content: item.content,
                        image: null
                    };
                    this.showModal = true;
                },

                async saveNews() {
                    const formData = new FormData();
                    formData.append('user_id', 1); // ganti sesuai user login
                    formData.append('category_id', this.form.category_id);
                    formData.append('title', this.form.title);
                    formData.append('excerpt', this.form.excerpt);
                    formData.append('content', this.form.content);
                    if (this.form.image) formData.append('image', this.form.image);

                    if (this.form.id) formData.append('_method', 'PUT');

                    const url = this.form.id ? `/api/news/${this.form.id}` : '/api/news';

                    try {
                        const res = await fetch(url, {
                            method: 'POST',
                            body: formData
                        });

                        if (res.ok) {
                            await this.loadNews();
                            this.closeModal();
                            this.showAlert(this.form.id ? 'Berita berhasil diperbarui!' :
                                'Berita berhasil ditambahkan!');
                        } else {
                            this.showAlert('Gagal menyimpan data!', 'error');
                        }
                    } catch (err) {
                        console.error(err);
                        this.showAlert('Terjadi kesalahan server!', 'error');
                    }
                },

                async deleteNews(id) {
                    if (!confirm('Hapus berita ini?')) return;

                    try {
                        const res = await fetch(`/api/news/${id}`, {
                            method: 'DELETE'
                        });

                        if (res.ok) {
                            await this.loadNews();
                            this.showAlert('Berita berhasil dihapus!');
                        } else {
                            this.showAlert('Gagal menghapus berita!', 'error');
                        }
                    } catch (err) {
                        console.error(err);
                        this.showAlert('Terjadi kesalahan server!', 'error');
                    }
                }
            };
        }
    </script>
@endsection
