<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make(12345),
        //     'role' => 'admin'
        // ]);

        // \App\Models\User::create([
        //     'name' => 'kasir',
        //     'email' => 'kasir@gmail.com',
        //     'password' => Hash::make(12345),
        //     'role' => 'kasir'
        // ]);

        \App\Models\User::create([
            'name' => 'dapur',
            'email' => 'dapur@gmail.com',
            'password' => Hash::make(12345),
            'role' => 'dapur'
        ]);
    }
}
