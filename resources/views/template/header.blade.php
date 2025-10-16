<header x-data="{ menuToggle: false, profileDropdown: false }"
    class="sticky top-0 z-50 flex w-full border-b border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">

    <div class="flex grow flex-col items-center justify-between lg:flex-row lg:px-6">

        <!-- Left Section -->
        <div
            class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 lg:justify-normal lg:border-b-0 lg:px-0 lg:py-4 dark:border-gray-800">

            <!-- Hamburger Toggle BTN -->
            <button
                :class="sidebarToggle ? 'lg:bg-transparent dark:lg:bg-transparent bg-gray-100 dark:bg-gray-800' : ''"
                class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg border-gray-200 text-gray-500 lg:h-11 lg:w-11 lg:border dark:border-gray-800 dark:text-gray-400"
                @click.stop="sidebarToggle = !sidebarToggle">

                <!-- Hamburger Icon -->
                <svg class="hidden fill-current lg:block" width="16" height="12" viewBox="0 0 16 12" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.583252 1C0.583252 0.585788 0.919038 0.25 1.33325 0.25H14.6666C15.0808 0.25 15.4166 0.585786 15.4166 1C15.4166 1.41421 15.0808 1.75 14.6666 1.75L1.33325 1.75C0.919038 1.75 0.583252 1.41422 0.583252 1ZM0.583252 11C0.583252 10.5858 0.919038 10.25 1.33325 10.25L14.6666 10.25C15.0808 10.25 15.4166 10.5858 15.4166 11C15.4166 11.4142 15.0808 11.75 14.6666 11.75L1.33325 11.75C0.919038 11.75 0.583252 11.4142 0.583252 11ZM1.33325 5.25C0.919038 5.25 0.583252 5.58579 0.583252 6C0.583252 6.41421 0.919038 6.75 1.33325 6.75L7.99992 6.75C8.41413 6.75 8.74992 6.41421 8.74992 6C8.74992 5.58579 8.41413 5.25 7.99992 5.25L1.33325 5.25Z"
                        fill="" />
                </svg>

                <!-- Mobile Menu Icon -->
                <svg :class="sidebarToggle ? 'hidden' : 'block lg:hidden'" class="fill-current lg:hidden" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M3.25 6C3.25 5.58579 3.58579 5.25 4 5.25L20 5.25C20.4142 5.25 20.75 5.58579 20.75 6C20.75 6.41421 20.4142 6.75 20 6.75L4 6.75C3.58579 6.75 3.25 6.41422 3.25 6ZM3.25 18C3.25 17.5858 3.58579 17.25 4 17.25L20 17.25C20.4142 17.25 20.75 17.5858 20.75 18C20.75 18.4142 20.4142 18.75 20 18.75L4 18.75C3.58579 18.75 3.25 18.4142 3.25 18ZM4 11.25C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75L12 12.75C12.4142 12.75 12.75 12.4142 12.75 12C12.75 11.5858 12.4142 11.25 12 11.25L4 11.25Z"
                        fill="" />
                </svg>

                <!-- Close Icon -->
                <svg :class="sidebarToggle ? 'block lg:hidden' : 'hidden'" class="fill-current" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.21967 7.28131C5.92678 6.98841 5.92678 6.51354 6.21967 6.22065C6.51256 5.92775 6.98744 5.92775 7.28033 6.22065L11.999 10.9393L16.7176 6.22078C17.0105 5.92789 17.4854 5.92788 17.7782 6.22078C18.0711 6.51367 18.0711 6.98855 17.7782 7.28144L13.0597 12L17.7782 16.7186C18.0711 17.0115 18.0711 17.4863 17.7782 17.7792C17.4854 18.0721 17.0105 18.0721 16.7176 17.7792L11.999 13.0607L7.28033 17.7794C6.98744 18.0722 6.51256 18.0722 6.21967 17.7794C5.92678 17.4865 5.92678 17.0116 6.21967 16.7187L10.9384 12L6.21967 7.28131Z"
                        fill="" />
                </svg>
            </button>
            <!-- /Hamburger Toggle BTN -->

            <!-- Logo -->
            <a href="index.html" class="lg:hidden">
                <img class="dark:hidden" src="{{ asset('tailadmin/build/src/images/logo/logo.svg') }}" alt="Logo" />
                <img class="hidden dark:block" src="{{ asset('tailadmin/build/src/images/logo/logo-dark.svg') }}"
                    alt="Logo" />
            </a>

            <!-- Right Section -->
            <div class="flex items-center gap-2 px-3 py-3 lg:gap-4 lg:px-0 lg:py-0 ml-auto">
                <!-- Profile Dropdown -->
                <div class="relative ml-auto" @click.away="profileDropdown = false">
                    <button @click="profileDropdown = !profileDropdown"
                        class="flex items-center gap-3 rounded-lg border border-gray-200 px-3 py-2 hover:bg-gray-50 lg:px-4 dark:border-gray-800 dark:hover:bg-gray-800">

                        <!-- Profile Image -->
                        <div class="h-8 w-8 overflow-hidden rounded-full lg:h-9 lg:w-9">
                            @if (auth()->user()->profile_user)
                                <img src="data:image/jpeg;base64,{{ base64_encode(auth()->user()->profile_user) }}"
                                    alt="{{ auth()->user()->username }}" class="h-full w-full object-cover">
                            @else
                                <!-- Default Avatar if no profile picture -->
                                <div
                                    class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-500 to-purple-600 text-white text-sm font-semibold">
                                    {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <!-- User Info (Hidden on mobile) -->
                        <div class="hidden text-left lg:block">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ auth()->user()->username }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ auth()->user()->role->name ?? 'User' }}
                            </p>
                        </div>

                        <!-- Dropdown Arrow -->
                        <svg class="fill-current text-gray-500 transition-transform dark:text-gray-400"
                            :class="profileDropdown ? 'rotate-180' : ''" width="12" height="12"
                            viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.46967 4.21967C2.76256 3.92678 3.23744 3.92678 3.53033 4.21967L6 6.68934L8.46967 4.21967C8.76256 3.92678 9.23744 3.92678 9.53033 4.21967C9.82322 4.51256 9.82322 4.98744 9.53033 5.28033L6.53033 8.28033C6.23744 8.57322 5.76256 8.57322 5.46967 8.28033L2.46967 5.28033C2.17678 4.98744 2.17678 4.51256 2.46967 4.21967Z"
                                fill="" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="profileDropdown" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute right-0 mt-2 w-56 rounded-lg border border-gray-200 bg-white shadow-lg dark:border-gray-800 dark:bg-gray-900"
                        style="display: none;">

                        <div class="p-3 border-b border-gray-200 dark:border-gray-800">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ auth()->user()->username }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                {{ auth()->user()->email }}
                            </p>
                        </div>

                        <div class="p-2">
                            <a href="/profile"
                                class="flex items-center gap-3 rounded-md px-3 py-2 text-sm text-gray-300 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                My Profile
                            </a>
                        </div>

                        <div class="border-t border-gray-200 p-2 dark:border-gray-800">
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</header>
