@extends('layout')

@section('title', 'Manajemen Profile')

@section('content')
    <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto" x-data="{ isProfileInfoModal: false, showPassword: false, showNewPassword: false, showConfirmPassword: false, previewImage: null }">
        <div class="w-full p-4 md:p-6">
            <!-- Success Message -->
            @if (session('success'))
                <div
                    class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg dark:bg-green-900/20 dark:border-green-800 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div
                    class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg dark:bg-red-900/20 dark:border-red-800 dark:text-red-400">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6 w-full">
                <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-7">
                    Detail Profile
                </h3>

                <!-- Profile Picture Section -->
                <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                    <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
                        <div class="flex flex-col items-center w-full gap-6 xl:flex-row">
                            <div class="w-20 h-20 overflow-hidden border border-gray-200 rounded-full dark:border-gray-800">
                                <img src="{{ $user->profile_image ?? asset('tailadmin/build/src/images/user/owner.jpg') }}"
                                    alt="user" class="w-full h-full object-cover" />
                            </div>
                            <div class="order-3 xl:order-2">
                                <h4
                                    class="mb-2 text-lg font-semibold text-center text-gray-800 dark:text-white/90 xl:text-left">
                                    {{ $user->username }}
                                </h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center xl:text-left">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>

                        <button @click="isProfileInfoModal = true"
                            class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-8 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 lg:inline-flex lg:w-auto">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                                    fill="" />
                            </svg>
                            Edit
                        </button>
                    </div>
                </div>

                <!-- Account Information Section -->
                <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-6">
                        Informasi Akun
                    </h4>

                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32">
                        <div>
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                Username
                            </p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $user->username }}
                            </p>
                        </div>

                        <div>
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                Email
                            </p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $user->email }}
                            </p>
                        </div>

                        <div>
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                Password
                            </p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                ••••••••
                            </p>
                        </div>

                        @if ($user->role)
                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                    Role
                                </p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $user->role->role_name }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Modal -->
        <div x-show="isProfileInfoModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">

            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black bg-opacity-50" @click="isProfileInfoModal = false"></div>

            <!-- Modal -->
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-lg max-w-xl w-full p-6"
                    @click.away="isProfileInfoModal = false">

                    <!-- Modal Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white">
                            Edit Profile
                        </h3>
                        <button @click="isProfileInfoModal = false"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Profile Picture Upload -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Foto Profile
                            </label>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-20 h-20 overflow-hidden border border-gray-200 rounded-full dark:border-gray-700">
                                    <img :src="previewImage ||
                                        '{{ $user->profile_image ?? asset('tailadmin/build/src/images/user/owner.jpg') }}'"
                                        alt="preview" class="w-full h-full object-cover" />
                                </div>
                                <div>
                                    <input type="file" name="profile_user" id="profile_user"
                                        accept="image/jpeg,image/png,image/jpg" class="hidden"
                                        @change="
                                               const file = $event.target.files[0];
                                               if (file) {
                                                   const reader = new FileReader();
                                                   reader.onload = (e) => previewImage = e.target.result;
                                                   reader.readAsDataURL(file);
                                               }
                                           ">
                                    <label for="profile_user"
                                        class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-white bg-white hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600">
                                        Pilih Foto
                                    </label>

                                    <p class="mt-2 text-xs text-gray-500">JPG, JPEG, PNG (Max: 2MB)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Username <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 dark:border-gray-700 my-6"></div>

                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Kosongkan jika tidak ingin mengubah password
                        </p>

                        <!-- Current Password -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Password Saat Ini
                            </label>
                            <div class="relative">
                                <input :type="showPassword ? 'text' : 'password'" name="current_password"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white pr-10">
                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Password Baru
                            </label>
                            <div class="relative">
                                <input :type="showNewPassword ? 'text' : 'password'" name="new_password"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white pr-10">
                                <button type="button" @click="showNewPassword = !showNewPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <svg x-show="!showNewPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showNewPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Konfirmasi Password Baru
                            </label>
                            <div class="relative">
                                <input :type="showConfirmPassword ? 'text' : 'password'" name="new_password_confirmation"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white pr-10">
                                <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <svg x-show="!showConfirmPassword" class="w-5 h-5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showConfirmPassword" class="w-5 h-5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 justify-end">
                            <button type="button" @click="isProfileInfoModal = false"
                                class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
