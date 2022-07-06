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

        DB::table('users')->insert([
            'fname' => 'Juan',
            'lname' => 'Cruz',
            'email' => 'admin@example.com',
            'role'  => 1,
            'status' => 1,
            'password' => Hash::make('password'),
        ]);

        $staff_id = DB::table('users')->insertGetId([
            'fname' => 'Pedro',
            'lname' => 'Morris',
            'email' => 'staff@example.com',
            'role'  => 2,
            'status' => 1,
            'password' => Hash::make('password'),
        ]);

        DB::table('staffs')->insert([
            'user_id' => $staff_id,
            'department_id' => null,
            'contact' => '09123456789',
            'birthdate' => '1988-08-08',
        ]);

        \App\Models\User::factory(100)->create();
    }
}
