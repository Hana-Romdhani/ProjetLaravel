<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Only create an admin if one doesn't already exist
        if (!User::where('role', 'admin')->exists()) {
            User::create([
                'nameUser' => 'AdminUser',   // Customize as needed
                'email' => 'admin@gmail.com',  // Customize as needed
                'password' => Hash::make('admin@gmail.com'),  // Set a strong password
                'role' => 'admin',
            ]);
        }
    }
}
