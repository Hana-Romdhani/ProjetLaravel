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
        // Check if the admin user already exists
        if (User::where('email', 'admin@admin.com')->doesntExist()) {
            // Create the default admin user
            User::create([
                'nameUser' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin@admin.com'),
                'role' => 'admin',
            ]);
        }
    }
}
