<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // ==============================
    // CRUD USER untuk ADMIN
    // ==============================

    public function index()
    {
        // Ambil semua user beserta relasinya (role)
        $users = User::with(['role:id,role_name'])
            ->orderBy('id', 'asc')
            ->get(['id', 'role_id', 'username', 'email', 'profile_user', 'created_at']);

        // Ubah BLOB foto profil jadi base64 agar bisa ditampilkan
        $users->transform(function ($user) {
            if ($user->profile_user) {
                $user->profile_user = 'data:image/jpeg;base64,' . base64_encode($user->profile_user);
            } else {
                $user->profile_user = null;
            }

            // pastikan relasi role muncul meski kosong
            $user->role = $user->role ? [
                'id' => $user->role->id,
                'role_name' => $user->role->role_name,
            ] : null;

            return $user;
        });

        return response()->json([
            'status' => 'Success',
            'message' => 'Daftar semua pengguna',
            'data' => $users
        ], 200);
    }


    public function show($id)
    {
        $user = User::with('role')
            ->select('id', 'role_id', 'username', 'email', 'profile_user', 'created_at')
            ->find($id);

        if (!$user) {
            return response()->json([
                'status' => 'Error',
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        if ($user->profile_user) {
            $user->profile_user = 'data:image/jpeg;base64,' . base64_encode($user->profile_user);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Detail user ditemukan',
            'data' => $user
        ], 200);
    }

    // 🔹 Tambah user baru (simpan foto sebagai BLOB)
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:18',
            'profile_user' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imageData = null;
        if ($request->hasFile('profile_user')) {
            $imageData = file_get_contents($request->file('profile_user')->getRealPath());
        }

        $user = User::create([
            'role_id' => $request->role_id,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_user' => $imageData,
        ]);

        $user->load('role');

        if ($user->profile_user) {
            $user->profile_user = 'data:image/jpeg;base64,' . base64_encode($user->profile_user);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'User berhasil ditambahkan',
            'data' => $user
        ], 201);
    }


    // 🔹 Update user (termasuk ubah foto BLOB)
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'Error',
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'role_id' => 'nullable|exists:roles,id',
            'username' => 'nullable|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:6|max:18',
            'profile_user' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->has('role_id')) $user->role_id = $request->role_id;
        if ($request->has('username')) $user->username = $request->username;
        if ($request->has('email')) $user->email = $request->email;
        if ($request->has('password')) $user->password = Hash::make($request->password);

        // jika ada file baru, simpan sebagai BLOB
        if ($request->hasFile('profile_user')) {
            $user->profile_user = file_get_contents($request->file('profile_user')->getRealPath());
        }

        $user->save();
        $user->load('role');

        if ($user->profile_user) {
            $user->profile_user = 'data:image/jpeg;base64,' . base64_encode($user->profile_user);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'User berhasil diperbarui',
            'data' => $user
        ], 200);
    }

    // 🔹 Hapus user (foto ikut hilang otomatis dari DB)
    public function destroyUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'Error',
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'User berhasil dihapus'
        ], 200);
    }

    // ==============================
    // METHOD LOGIN/REGISTER/LOGOUT
    // ==============================

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:18'
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $token = $user->createToken('signup-token')->plainTextToken;

        return response()->json([
            'status' => 'Success',
            'message' => 'Register Success!',
            'token' => $token,
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:16'
        ]);

        $remember = $request->has('remember');

        if (!auth()->attempt($request->only('email', 'password'), $remember)) {
            return back()->with('error', 'Email atau password tidak valid');
        }

        $request->session()->regenerate();

        return redirect()->intended('/dashboard')->with('success', 'Selamat datang kembali!');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout');
    }

    // ==============================
    // PROFILE USER (untuk user yang sedang login)
    // ==============================

    /**
     * Tampilkan halaman profile
     */
    public function profile()
    {
        // Load user dengan relasi role
        $user = User::with('role')->find(Auth::id());

        // Convert BLOB to base64 untuk ditampilkan
        if ($user->profile_user) {
            $user->profile_image = 'data:image/jpeg;base64,' . base64_encode($user->profile_user);
        } else {
            $user->profile_image = null;
        }

        return view('settings.profile', compact('user'));
    }

    /**
     * Update profile user yang sedang login
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => ['required', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|max:18|confirmed',
            'profile_user' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Update username dan email
        $user->username = $request->username;
        $user->email = $request->email;

        // Update password jika diisi
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai'])->withInput();
            }

            $user->password = Hash::make($request->new_password);
        }

        // Update profile picture jika ada file baru
        if ($request->hasFile('profile_user')) {
            $imageData = file_get_contents($request->file('profile_user')->getRealPath());
            $user->profile_user = $imageData;
        }

        $user->save();

        return back()->with('success', 'Profile berhasil diperbarui!');
    }

    /**
     * Hapus foto profile
     */
    public function deleteProfilePicture()
    {
        $user = Auth::user();
        $user->profile_user = null;
        $user->save();

        return back()->with('success', 'Foto profile berhasil dihapus');
    }
}
