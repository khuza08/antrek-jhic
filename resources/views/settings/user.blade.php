@extends('layout')

@section('title', 'Manajemen User')

@section('content')
    <div x-data="userApp()" x-init="init()" class="p-4 mx-auto max-w-screen-2xl md:p-6">
        <h1 class="text-white text-2xl font-semibold mb-4">Manajemen User</h1>

        <!-- Container -->
        <div class="bg-gray-800 text-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar User</h2>
                <button @click="openModal()" class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Tambah User</button>
            </div>

            <!-- Alert -->
            <template x-if="alertMessage">
                <div class="p-3 mb-4 rounded text-white" :class="alertType === 'success' ? 'bg-green-600' : 'bg-red-600'"
                    x-text="alertMessage">
                </div>
            </template>

            <!-- Table -->
            <div class="overflow-x-auto rounded-lg">
                <div class="w-full text-left border-collapse min-w-[600px]">
                    <table class="w-full text-left border-collapse">
                        <thead class="border-b border-gray-600">
                            <tr>
                                <th class="py-2 px-3">No</th>
                                <th class="py-2 px-3">Foto</th>
                                <th class="py-2 px-3">Username</th>
                                <th class="py-2 px-3">Email</th>
                                <th class="py-2 px-3">Role</th>
                                <th class="py-2 px-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(user, index) in users" :key="user.id">
                                <tr class="border-b border-gray-700 hover:bg-gray-700">
                                    <td class="py-2 px-3" x-text="index + 1"></td>
                                    <td class="py-2 px-3">
                                        <img :src="user.profile_user ||
                                            'https://ui-avatars.com/api/?name=' + encodeURIComponent(user.username)"
                                            alt="Foto Profil" class="w-10 h-10 rounded-full object-cover">
                                    </td>
                                    <td class="py-2 px-3" x-text="user.username"></td>
                                    <td class="py-2 px-3" x-text="user.email"></td>
                                    <td class="py-2 px-3" x-text="getRoleName(user)"></td>

                                    <td class="py-2 px-3 space-x-2">
                                        <button @click="editUser(user)"
                                            class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-500">Edit</button>
                                        <button @click="deleteUser(user.id)"
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
        <div x-show="showModal" class="fixed inset-0 bg-black/60 z-50 flex justify-center items-start overflow-y-auto p-4"
            x-transition>
            <div class="bg-gray-900 p-6 rounded-lg w-full max-w-lg text-white max-h-[90vh] overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4" x-text="form.id ? `Edit User` : `Tambah User`"></h2>

                <form @submit.prevent="saveUser" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="block mb-1">Username</label>
                        <input type="text" x-model="form.username" required
                            class="w-full rounded p-2 bg-gray-800 border border-gray-700 text-white">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Email</label>
                        <input type="email" x-model="form.email" required
                            class="w-full rounded p-2 bg-gray-800 border border-gray-700 text-white">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Password <span class="text-gray-400 text-sm" x-show="form.id">(Kosongkan
                                jika tidak ingin mengubah)</span></label>
                        <input type="password" x-model="form.password" placeholder="••••••" :required="!form.id"
                            class="w-full rounded p-2 bg-gray-800 border border-gray-700 text-white">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1">Role</label>
                        <select x-model="form.role_id" required
                            class="w-full rounded p-2 bg-gray-800 border border-gray-700 text-white">
                            <option value="">Pilih Role</option>
                            <template x-for="role in roles" :key="role.id">
                                <option :value="role.id" x-text="role.role_name"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Foto Profil -->
                    <div class="mb-4">
                        <label class="block mb-1">Foto Profil</label>
                        <input type="file" @change="previewImage" accept="image/*"
                            class="w-full text-sm text-gray-400 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500" />
                        <template x-if="preview">
                            <img :src="preview"
                                class="mt-3 w-24 h-24 rounded-full object-cover border border-gray-700">
                        </template>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="closeModal"
                            class="bg-gray-600 px-3 py-1 rounded hover:bg-gray-500">Batal</button>
                        <button type="submit" class="bg-green-600 px-3 py-1 rounded hover:bg-green-500">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function userApp() {
            return {
                users: [],
                roles: [],
                showModal: false,
                alertMessage: '',
                alertType: 'success',
                preview: null,
                form: {
                    id: null,
                    username: '',
                    email: '',
                    password: '',
                    role_id: '',
                    profile_user: null,
                },

                async init() {
                    await this.loadUsers();
                    await this.loadRoles();
                },

                getRoleName(user) {
                    if (user.role && user.role.role_name) {
                        return user.role.role_name;
                    }
                    return '-';
                },

                async loadUsers() {
                    try {
                        const res = await fetch('/api/users');
                        const data = await res.json();
                        this.users = data.data || data;
                    } catch (e) {
                        console.error('Gagal memuat data user:', e);
                    }
                },

                async loadRoles() {
                    try {
                        const res = await fetch('/api/roles');
                        const data = await res.json();
                        this.roles = data.data || data;
                    } catch (e) {
                        console.error('Gagal memuat role:', e);
                    }
                },

                openModal() {
                    this.resetForm();
                    this.showModal = true;
                },

                closeModal() {
                    this.showModal = false;
                    this.preview = null;
                },

                editUser(user) {
                    this.form = {
                        id: user.id,
                        username: user.username,
                        email: user.email,
                        password: '',
                        role_id: user.role_id || (user.role ? user.role.id : ''),
                        profile_user: null,
                    };
                    this.preview = user.profile_user;
                    this.showModal = true;
                },

                previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.form.profile_user = file;
                        this.preview = URL.createObjectURL(file);
                    }
                },

                async saveUser() {
                    try {
                        const method = 'POST';
                        const url = this.form.id ? `/api/users/${this.form.id}` : '/api/users';

                        const formData = new FormData();
                        for (const key in this.form) {
                            if (this.form[key] !== null && this.form[key] !== '') {
                                formData.append(key, this.form[key]);
                            }
                        }
                        if (this.form.id) formData.append('_method', 'PUT');

                        const res = await fetch(url, {
                            method,
                            body: formData
                        });

                        if (!res.ok) {
                            const errorData = await res.json();
                            throw errorData;
                        }

                        this.alertMessage = this.form.id ? 'User berhasil diperbarui!' : 'User berhasil ditambahkan!';
                        this.alertType = 'success';
                        this.showModal = false;
                        await this.loadUsers();
                        setTimeout(() => (this.alertMessage = ''), 3000);
                    } catch (e) {
                        console.error(e);
                        this.alertMessage = e.message || 'Terjadi kesalahan, silakan coba lagi.';
                        this.alertType = 'error';
                        setTimeout(() => (this.alertMessage = ''), 3000);
                    }
                },

                async deleteUser(id) {
                    if (!confirm('Yakin ingin menghapus user ini?')) return;
                    try {
                        const res = await fetch(`/api/users/${id}`, {
                            method: 'DELETE'
                        });

                        if (!res.ok) {
                            const errorData = await res.json();
                            throw errorData;
                        }

                        this.alertMessage = 'User berhasil dihapus!';
                        this.alertType = 'success';
                        await this.loadUsers();
                    } catch (e) {
                        console.error(e);
                        this.alertMessage = e.message || 'Gagal menghapus user.';
                        this.alertType = 'error';
                    }
                    setTimeout(() => (this.alertMessage = ''), 3000);
                },

                resetForm() {
                    this.form = {
                        id: null,
                        username: '',
                        email: '',
                        password: '',
                        role_id: '',
                        profile_user: null,
                    };
                    this.preview = null;
                },
            };
        }
    </script>
@endsection
