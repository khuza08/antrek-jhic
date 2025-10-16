<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profile user yang sedang login
     */
    public function show()
    {
        $user = Auth::user();

        return view('settings.profile', compact('user'));
    }

    /**
     * Update profile user (username, email, foto profil)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_user' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Update username & email
        $user->username = $request->username;
        $user->email = $request->email;

        // Jika ada upload foto baru
        if ($request->hasFile('profile_user')) {
            $imageData = file_get_contents($request->file('profile_user')->getRealPath());
            $user->profile_user = $imageData;
        }

        $user->save();

        return back()->with('success', 'Profile berhasil diperbarui!');
    }

    /**
     * Update password user
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6|max:18',
        ]);

        $user = Auth::user();

        // Cek apakah password lama benar
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }

        // Update password baru
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}
