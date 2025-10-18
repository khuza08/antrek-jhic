@extends('layout')

@section('title', 'Manajemen Guru')

@section('content')
    <div x-data="teacherManager()" x-init="fetchTeachers();
    fetchRoles();" class="p-4 mx-auto max-w-screen-2xl md:p-6 text-white">

        <h1 class="text-2xl font-semibold mb-4">Manajemen Guru</h1>

        <div class="bg-gray-800 rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar Guru</h2>
                <button @click="openModal('create')" class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Tambah
                    Guru</button>
            </div>

            <div class="overflow-x-auto rounded-lg">
                <div class="w-full text-left border-collapse min-w-[600px]">
                    <table class="w-full text-left border-collapse">
                        <thead class="border-b border-gray-600">
                            <tr>
                                <th class="py-2 px-3">No</th>
                                <th class="py-2 px-3">Nama</th>
                                <th class="py-2 px-3">Deskripsi</th>
                                <th class="py-2 px-3">Rate</th>
                                <th class="py-2 px-3">Foto</th>
                                <th class="py-2 px-3">Role</th>
                                <th class="py-2 px-3">Dibuat</th>
                                <th class="py-2 px-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-if="teachers.length === 0">
                                <tr>
                                    <td colspan="8" class="text-center py-4">Belum ada data</td>
                                </tr>
                            </template>

                            <template x-for="(t, i) in teachers" :key="t.id">
                                <tr class="border-b border-gray-700 hover:bg-gray-700">
                                    <td class="py-2 px-3" x-text="i + 1"></td>
                                    <td class="py-2 px-3" x-text="t.name"></td>
                                    <td class="py-2 px-3" x-text="t.description ?? '-'"></td>
                                    <td class="py-2 px-3" x-text="t.rate ?? '-'"></td>
                                    <td class="py-2 px-3">
                                        <template x-if="t.image">
                                            <img :src="`/storage/${t.image}`" alt=""
                                                class="w-10 h-10 rounded-full object-cover">
                                        </template>
                                        <template x-if="!t.image">
                                            <div
                                                class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center text-sm">
                                                N/A</div>
                                        </template>
                                    </td>
                                    <td class="py-2 px-3" x-text="t.role?.role_name ?? '-'"></td>
                                    <td class="py-2 px-3" x-text="new Date(t.created_at).toLocaleString()"></td>
                                    <td class="py-2 px-3">
                                        <div
                                            class="flex flex-col sm:flex-row justify-between sm:justify-start gap-2 sm:gap-1">
                                            <button @click="openModal('edit', t)"
                                                class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-500 text-sm sm:text-base">
                                                Edit
                                            </button>
                                            <button @click="deleteTeacher(t.id)"
                                                class="bg-red-600 px-3 py-1 rounded hover:bg-red-500 text-sm sm:text-base">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="modalOpen" class="fixed inset-0 bg-black/60 z-40 flex justify-center items-start overflow-y-auto p-4"
            x-transition>
            <div class="bg-gray-900 p-6 rounded-lg w-full max-w-lg text-white max-h-[90vh] overflow-y-auto">
                <h2 class="text-lg font-semibold mb-4" x-text="modalMode === 'create' ? 'Tambah Guru' : 'Edit Guru'"></h2>

                <form @submit.prevent="saveTeacher" enctype="multipart/form-data">
                    <!-- Dropdown Role -->
                    <div class="mb-3">
                        <label class="block mb-1 text-sm">Role</label>
                        <select x-model="form.role_id" class="w-full p-2 rounded bg-gray-700 border border-gray-600"
                            required>
                            <option value="">-- Pilih Role --</option>
                            <template x-for="role in roles" :key="role.id">
                                <option :value="role.id" x-text="role.role_name"></option>
                            </template>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1 text-sm">Nama Guru</label>
                        <input type="text" x-model="form.name"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600" required>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1 text-sm">Deskripsi</label>
                        <textarea x-model="form.description" rows="2" class="w-full p-2 rounded bg-gray-700 border border-gray-600"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1 text-sm">Rate</label>
                        <input type="number" x-model="form.rate" step="0.1" min="0" max="5"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1 text-sm">Foto</label>
                        <input type="file" @change="handleFile" accept="image/*" class="w-full text-sm text-gray-300">
                    </div>

                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" @click="closeModal()"
                            class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-500">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 rounded hover:bg-green-500">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function teacherManager() {
            return {
                teachers: [],
                roles: [],
                modalOpen: false,
                modalMode: 'create',
                form: {
                    id: null,
                    name: '',
                    description: '',
                    rate: '',
                    role_id: '',
                    image: null
                },

                async fetchTeachers() {
                    try {
                        const res = await fetch('/api/teachers');
                        this.teachers = await res.json();
                    } catch (e) {
                        console.error('Error fetching teachers:', e);
                    }
                },

                async fetchRoles() {
                    try {
                        const res = await fetch('/api/roles');
                        this.roles = await res.json();
                    } catch (e) {
                        console.error('Error fetching roles:', e);
                    }
                },

                handleFile(e) {
                    this.form.image = e.target.files[0];
                },

                openModal(mode, teacher = null) {
                    this.modalMode = mode;
                    this.modalOpen = true;
                    this.form = teacher ? {
                        id: teacher.id,
                        name: teacher.name,
                        description: teacher.description,
                        rate: teacher.rate,
                        role_id: teacher.role_id,
                        image: null
                    } : {
                        id: null,
                        name: '',
                        description: '',
                        rate: '',
                        role_id: '',
                        image: null
                    };
                },

                closeModal() {
                    this.modalOpen = false;
                    this.form = {
                        id: null,
                        name: '',
                        description: '',
                        rate: '',
                        role_id: '',
                        image: null
                    };
                },

                async saveTeacher() {
                    const formData = new FormData();
                    for (const key in this.form) {
                        if (this.form[key] !== null && this.form[key] !== '') {
                            formData.append(key, this.form[key]);
                        }
                    }

                    const url = this.modalMode === 'create' ? '/api/teachers' : `/api/teachers/${this.form.id}`;
                    const method = this.modalMode === 'create' ? 'POST' : 'POST';
                    if (this.modalMode === 'edit') formData.append('_method', 'PUT');

                    try {
                        const res = await fetch(url, {
                            method,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: formData
                        });

                        if (res.ok) {
                            this.closeModal();
                            this.fetchTeachers();
                            alert('Data guru berhasil disimpan!');
                        } else {
                            const err = await res.json();
                            alert(err.message || 'Gagal menyimpan data.');
                        }
                    } catch (e) {
                        console.error('Error saving teacher:', e);
                    }
                },

                async deleteTeacher(id) {
                    if (!confirm('Yakin ingin menghapus guru ini?')) return;
                    try {
                        const res = await fetch(`/api/teachers/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        if (res.ok) {
                            this.fetchTeachers();
                            alert('Guru berhasil dihapus!');
                        } else {
                            alert('Gagal menghapus guru.');
                        }
                    } catch (e) {
                        console.error('Error deleting teacher:', e);
                    }
                }
            }
        }
    </script>
@endsection
