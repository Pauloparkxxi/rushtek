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
            'avatar' => '1.jpg',
            'role'  => 1,
            'status' => 1,
            'password' => Hash::make('password'),
        ]);

        $staff_id = DB::table('users')->insertGetId([
            'fname' => 'Pedro',
            'lname' => 'Morris',
            'email' => 'staff@example.com',
            'avatar' => '',
            'role'  => 2,
            'status' => 1,
            'password' => Hash::make('password'),
        ]);

        DB::table('staff')->insert([
            'user_id' => $staff_id,
            'department_id' => null,
            'contact' => '09123456789',
            'birthdate' => '1988-08-08',
        ]);

        $client_id = DB::table('users')->insertGetId([
            'fname' => 'Tomas',
            'lname' => 'Philip',
            'email' => 'client@example.com',
            'avatar' => '',
            'role'  => 3,
            'status' => 1,
            'password' => Hash::make('password'),
        ]);

        DB::table('clients')->insert([
            'user_id' => $client_id,
            'contact' => '09123456789',
            'company' => 'Company 1',
        ]);

        \App\Models\Department::factory(100)->create();
        \App\Models\User::factory(100)->create();
    }
}
