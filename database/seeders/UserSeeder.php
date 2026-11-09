<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = env('SEED_ADMIN_PASSWORD') ?: Str::random(16);

        User::create([
            'name' => 'Admin',
            'email' => env('SEED_ADMIN_EMAIL', 'admin@gpb.com'),
            'password' => Hash::make($password),
        ]);

        if (! env('SEED_ADMIN_PASSWORD')) {
            $this->command?->warn("Generated admin password: {$password}");
        }
    }
}
