@extends('layout')

@section('title', 'Manajemen Role')

@section('content')
    <div x-data="roleManager()" x-init="fetchRoles()" class="p-4 mx-auto max-w-screen-2xl md:p-6 text-white">
        <h1 class="text-2xl font-semibold mb-4">Manajemen Role</h1>

        <!-- Table Container -->
        <div class="bg-gray-800 rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar Role</h2>
                <button @click="openModal('create')" class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Tambah
                    Role</button>
            </div>

            <div class="overflow-x-auto rounded-lg">
                <div class="w-full text-left border-collapse min-w-[600px]">
                    <table class="w-full text-left border-collapse">
                        <thead class="border-b border-gray-600">
                            <tr>
                                <th class="py-2 px-3">No</th>
                                <th class="py-2 px-3">Nama Role</th>
                                <th class="py-2 px-3">Deskripsi</th>
                                <th class="py-2 px-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-if="roles.length === 0">
                                <tr>
                                    <td colspan="4" class="text-center py-4">Belum ada data</td>
                                </tr>
                            </template>

                            <template x-for="(role, index) in roles" :key="role.id">
                                <tr class="border-b border-gray-700 hover:bg-gray-700">
                                    <td class="py-2 px-3" x-text="index + 1"></td>
                                    <td class="py-2 px-3" x-text="role.role_name"></td>
                                    <td class="py-2 px-3" x-text="role.description ?? '-'"></td>
                                    <td class="py-2 px-3">
                                        <button @click="openModal('edit', role)"
                                            class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-500">Edit</button>
                                        <button @click="deleteRole(role.id)"
                                            class="bg-red-600 px-3 py-1 rounded hover:bg-red-500 ml-2">Hapus</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="modalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            x-transition>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-lg font-semibold mb-4" x-text="modalMode === 'create' ? 'Tambah Role' : 'Edit Role'"></h2>

                <form @submit.prevent="saveRole">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm">Nama Role</label>
                        <input type="text" x-model="form.role_name"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring focus:ring-green-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm">Deskripsi</label>
                        <textarea x-model="form.description"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring focus:ring-green-500" rows="3"></textarea>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="closeModal()"
                            class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-500">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 rounded hover:bg-green-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function roleManager() {
            return {
                roles: [],
                modalOpen: false,
                modalMode: 'create',
                form: {
                    id: null,
                    role_name: '',
                    description: ''
                },

                async fetchRoles() {
                    try {
                        const res = await fetch('/api/roles');
                        this.roles = await res.json();
                    } catch (e) {
                        console.error('Error fetching roles:', e);
                        alert('Gagal memuat data role.');
                    }
                },

                openModal(mode, role = null) {
                    this.modalMode = mode;
                    this.modalOpen = true;
                    this.form = role ? {
                        ...role
                    } : {
                        id: null,
                        role_name: '',
                        description: ''
                    };
                },

                closeModal() {
                    this.modalOpen = false;
                    this.form = {
                        id: null,
                        role_name: '',
                        description: ''
                    };
                },

                async saveRole() {
                    const url = this.modalMode === 'create' ?
                        '/api/roles' :
                        `/api/roles/${this.form.id}`;

                    const method = this.modalMode === 'create' ? 'POST' : 'PUT';

                    try {
                        const res = await fetch(url, {
                            method,
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.form)
                        });

                        if (res.ok) {
                            this.closeModal();
                            this.fetchRoles();
                            alert('Data berhasil disimpan!');
                        } else {
                            const err = await res.json();
                            alert(err.message || 'Terjadi kesalahan saat menyimpan data.');
                        }
                    } catch (e) {
                        console.error('Error saving role:', e);
                    }
                },

                async deleteRole(id) {
                    if (!confirm('Yakin ingin menghapus role ini?')) return;

                    try {
                        const res = await fetch(`/api/roles/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        if (res.ok) {
                            this.fetchRoles();
                            alert('Role berhasil dihapus!');
                        } else {
                            alert('Gagal menghapus role.');
                        }
                    } catch (e) {
                        console.error('Error deleting role:', e);
                    }
                }
            }
        }
    </script>
@endsection
