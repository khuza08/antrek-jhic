@extends('layout')

@section('title', 'Manajemen Kategori')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div x-data="kategoriHandler()" x-init="loadCategories()" class="p-4 mx-auto max-w-screen-2xl md:p-6 text-white">
        <h1 class="text-2xl font-semibold mb-4">Manajemen Kategori</h1>

        <div class="bg-gray-800 rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar Kategori</h2>
                <button @click="openModal()" class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">
                    Tambah Kategori
                </button>
            </div>

            <div class="overflow-x-auto rounded-lg">
                <div class="w-full text-left border-collapse min-w-[600px]">
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
                        <tbody>
                            <template x-if="categories.length === 0">
                                <tr>
                                    <td colspan="5" class="text-center py-4">Belum ada data</td>
                                </tr>
                            </template>

                            <template x-for="(cat, index) in categories" :key="cat.id">
                                <tr class="border-b border-gray-700 hover:bg-gray-700">
                                    <td class="py-2 px-3" x-text="index + 1"></td>
                                    <td class="py-2 px-3" x-text="cat.name"></td>
                                    <td class="py-2 px-3" x-text="cat.slug"></td>
                                    <td class="py-2 px-3" x-text="cat.description"></td>
                                    <td class="py-2 px-3 space-x-2">
                                        <button @click="editCategory(cat)"
                                            class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-500">
                                            Edit
                                        </button>
                                        <button @click="deleteCategory(cat.id)"
                                            class="bg-red-600 px-3 py-1 rounded hover:bg-red-500">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Modal Box Start --}}
        <div x-show="showModal" x-transition x-cloak
            class="fixed inset-0 bg-black/60 z-60 flex justify-center items-center overflow-y-auto p-4">
            <!-- Perhatikan perubahan: `items-start` -> `items-center` -->
            <div @click.away="closeModal()"
                class="bg-gray-900 rounded-lg shadow-lg w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4" x-text="isEdit ? 'Edit Kategori' : 'Tambah Kategori'"></h2>

                <form @submit.prevent="saveCategory">
                    @csrf
                    <div class="mb-3">
                        <label class="block mb-1">Nama Kategori</label>
                        <input type="text" x-model="form.name"
                            class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-green-500"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Slug</label>
                        <input type="text" x-model="form.slug"
                            class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-green-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Deskripsi</label>
                        <textarea x-model="form.description" rows="3"
                            class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-green-500" required></textarea>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="closeModal()"
                            class="bg-gray-600 px-4 py-2 rounded hover:bg-gray-500">
                            Batal
                        </button>
                        <button type="submit" class="bg-green-600 px-4 py-2 rounded hover:bg-green-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Modal Box End --}}
    </div>

    <script>
        function kategoriHandler() {
            return {
                categories: [],
                showModal: false,
                isEdit: false,
                csrf: document.querySelector('meta[name="csrf-token"]').content,
                form: {
                    id: '',
                    name: '',
                    slug: '',
                    description: ''
                },

                async loadCategories() {
                    try {
                        const res = await fetch('/api/categories');
                        const data = await res.json();
                        this.categories = data.categories || [];
                    } catch (err) {
                        alert('Gagal memuat kategori.');
                    }
                },

                openModal() {
                    this.resetForm();
                    this.isEdit = false;
                    this.showModal = true;
                },

                editCategory(cat) {
                    this.form = {
                        ...cat
                    };
                    this.isEdit = true;
                    this.showModal = true;
                },

                closeModal() {
                    this.showModal = false;
                },

                resetForm() {
                    this.form = {
                        id: '',
                        name: '',
                        slug: '',
                        description: ''
                    };
                },

                async saveCategory() {
                    const url = this.isEdit ?
                        `/api/categories/${this.form.id}` :
                        '/api/categories';
                    const method = this.isEdit ? 'PUT' : 'POST';

                    try {
                        const res = await fetch(url, {
                            method,
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': this.csrf
                            },
                            body: JSON.stringify(this.form)
                        });

                        if (!res.ok) throw new Error('Gagal menyimpan data');
                        alert('Data berhasil disimpan!');
                        this.closeModal();
                        this.loadCategories();
                    } catch (err) {
                        alert(err.message);
                    }
                },

                async deleteCategory(id) {
                    if (!confirm('Yakin ingin menghapus kategori ini?')) return;
                    try {
                        const res = await fetch(`/api/categories/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': this.csrf
                            }
                        });
                        if (!res.ok) throw new Error('Gagal menghapus');
                        alert('Berhasil dihapus!');
                        this.loadCategories();
                    } catch (err) {
                        alert(err.message);
                    }
                }
            }
        }
    </script>
@endsection
