@extends('layout')

@section('title', 'Manajemen Jurusan')

@section('content')
    <div x-data="majorHandler()" x-init="loadMajors();
    loadCategories()" class="p-4 mx-auto max-w-screen-2xl md:p-6 text-white">
        <h1 class="text-2xl font-semibold mb-4">Manajemen Jurusan</h1>

        <div class="bg-gray-800 rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar Jurusan</h2>
                <button @click="openModal()" class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">
                    Tambah Jurusan
                </button>
            </div>

            <div class="overflow-x-auto rounded-lg">
                <div class="w-full text-left border-collapse min-w-[700px]">
                    <table class="w-full text-left border-collapse">
                        <thead class="border-b border-gray-600">
                            <tr>
                                <th class="py-2 px-3">No</th>
                                <th class="py-2 px-3">Nama</th>
                                <th class="py-2 px-3">Kategori</th>
                                <th class="py-2 px-3">Deskripsi</th>
                                <th class="py-2 px-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-if="majors.length === 0">
                                <tr>
                                    <td colspan="5" class="text-center py-4">Belum ada data</td>
                                </tr>
                            </template>

                            <template x-for="(m, index) in majors" :key="m.id">
                                <tr class="border-b border-gray-700 hover:bg-gray-700">
                                    <td class="py-2 px-3" x-text="index + 1"></td>
                                    <td class="py-2 px-3" x-text="m.name"></td>
                                    <td class="py-2 px-3" x-text="m.category ? m.category.name : '-'"></td>
                                    <td class="py-2 px-3" x-text="m.description || '-'"></td>
                                    <td class="py-2 px-3 space-x-2">
                                        <button @click="editMajor(m)"
                                            class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-500">
                                            Edit
                                        </button>
                                        <button @click="deleteMajor(m.id)"
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

        <!-- Modal -->
        <div x-show="showModal" x-transition x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
            <div @click.away="closeModal()" class="bg-gray-900 rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-xl font-semibold mb-4" x-text="isEdit ? 'Edit Jurusan' : 'Tambah Jurusan'"></h2>

                <form @submit.prevent="saveMajor">
                    <!-- Nama Jurusan -->
                    <div class="mb-3">
                        <label class="block mb-1">Nama Jurusan</label>
                        <input type="text" x-model="form.name"
                            class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-green-500"
                            required>
                    </div>

                    <!-- Dropdown Kategori -->
                    <div class="mb-3">
                        <label class="block mb-1">Kategori</label>
                        <select x-model="form.category_id"
                            class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-green-500">
                            <option value="">-- Pilih Kategori --</option>
                            <template x-for="cat in categories" :key="cat.id">
                                <option :value="cat.id" x-text="cat.name"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="block mb-1">Deskripsi</label>
                        <textarea x-model="form.description" rows="3"
                            class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-green-500"></textarea>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="closeModal()"
                            class="bg-gray-600 px-4 py-2 rounded hover:bg-gray-500">Batal</button>
                        <button type="submit" class="bg-green-600 px-4 py-2 rounded hover:bg-green-500">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function majorHandler() {
            return {
                majors: [],
                categories: [],
                showModal: false,
                isEdit: false,
                csrf: document.querySelector('meta[name=csrf-token]').content,
                form: {
                    id: '',
                    name: '',
                    description: '',
                    category_id: ''
                },

                async loadMajors() {
                    try {
                        const res = await fetch('/api/majors');
                        const data = await res.json();
                        this.majors = data;
                    } catch (err) {
                        console.error(err);
                        alert('Gagal memuat data jurusan.');
                    }
                },

                async loadCategories() {
                    try {
                        const res = await fetch('/api/categories');
                        const data = await res.json();
                        this.categories = data.categories || [];
                    } catch (err) {
                        console.error(err);
                        alert('Gagal memuat kategori.');
                    }
                },

                openModal() {
                    this.resetForm();
                    this.isEdit = false;
                    this.showModal = true;
                },

                editMajor(m) {
                    this.form = {
                        id: m.id,
                        name: m.name,
                        description: m.description,
                        category_id: m.category_id || (m.category ? m.category.id : '')
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
                        description: '',
                        category_id: ''
                    };
                },

                async saveMajor() {
                    const url = this.isEdit ? `/api/majors/${this.form.id}` : '/api/majors';
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
                        this.loadMajors();
                    } catch (err) {
                        console.error(err);
                        alert(err.message);
                    }
                },

                async deleteMajor(id) {
                    if (!confirm('Yakin ingin menghapus jurusan ini?')) return;
                    try {
                        const res = await fetch(`/api/majors/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': this.csrf
                            }
                        });
                        if (!res.ok) throw new Error('Gagal menghapus');
                        alert('Berhasil dihapus!');
                        this.loadMajors();
                    } catch (err) {
                        alert(err.message);
                    }
                }
            };
        }
    </script>
@endsection
