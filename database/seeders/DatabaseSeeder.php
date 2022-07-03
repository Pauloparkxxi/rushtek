<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'fname' => 'Juan',
            'lname' => 'Cruz',
            'email' => 'admin@example.com',
            'role'  => 1,
            'status' => 1,
            'password' => Hash::make('password'),
        ]);
    }
}
