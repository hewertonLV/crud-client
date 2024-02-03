<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('users')->where('name', 'admin')->doesntExist()) {
            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@teste.com',
                'password' => Hash::make('admin1')
            ]);
        }

        if (DB::table('users')->where('name', 'root')->doesntExist()) {
            DB::table('users')->insert([
                'name' => 'root',
                'email' => 'root@teste.com',
                'password' => Hash::make('root1')
            ]);
        }

    }
}
