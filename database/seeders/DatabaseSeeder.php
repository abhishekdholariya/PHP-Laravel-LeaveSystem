<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // add three departments using DB inser
        DB::table('departments')->insert([
            [
                'name' => 'Computer Science',
            ],
            [
                'name' => 'Electronics',
            ],
            [
                'name' => 'Mechanical',
            ],
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Renav',
                'email' => 'admin@gmail.com',
                'phone' => '1234567890',
                'role' => 2,
                'department_id' => null,
                'password' => Hash::make('123'),
                'leaves'=>18
            ],
            [
                'name' => 'Rahul',
                'email' => 'rahul@gmail.com',
                'phone' => '1234567891',
                'role' => 1,
                'department_id' => 1,
                'leaves'=>18,
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'roy',
                'email' => 'roy@gmail.com',
                'phone' => '1234567893',
                'role' => 0,
                'leaves'=>18,
                'department_id' => 1,
                'password' => Hash::make('123'),
            ]
        ]);
    }
}
