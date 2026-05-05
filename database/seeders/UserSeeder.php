<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin CAPEU',
            'email' => 'admin@capeu.unma.ac.id',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');
    }
}
