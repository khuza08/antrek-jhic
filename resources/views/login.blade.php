<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-gray-800 rounded-2xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-center mb-6 text-white">Selamat Datang 👋</h1>
        <p class="text-center text-gray-400 mb-5 text-sm">Silakan login untuk melanjutkan ke dashboard admin</p>

        <!-- Alert untuk pesan sukses/gagal -->
        @if (session('success'))
            <div class="bg-green-600 text-white p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-600 text-white p-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium mb-2" for="email">Email</label>
                <input type="email" id="email" name="email"
                    class="w-full bg-gray-700 text-white px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="email@example.com" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium mb-2" for="password">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password"
                        class="w-full bg-gray-700 text-white px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="********" required>
                    <!-- Tombol show/hide -->
                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-white focus:outline-none">
                        👁️
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm">
                    <input type="checkbox" name="remember"
                        class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500">
                    <span class="ml-2 text-gray-300">Ingat saya</span>
                </label>
                <a href="#" class="text-sm text-blue-500 hover:underline">Lupa Password?</a>
            </div>

            <!-- Tombol login -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-500 transition text-white font-semibold py-2 rounded-lg">
                Login
            </button>
        </form>
    </div>

    <!-- Script Show Password -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.textContent = type === 'password' ? '👁️' : '🙈';
        });
    </script>

</body>

</html>
