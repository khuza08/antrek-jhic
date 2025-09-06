<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user admin
        $user = User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Buat personal access token untuk user admin
        $token = $user->createToken('AdminToken', ['*']); // abilities = ['*'] = akses full
        $plainTextToken = $token->plainTextToken;

        // Tampilkan token di console setelah seeding
        $this->command->info('Personal Access Token: ' . $plainTextToken);
    }
}
