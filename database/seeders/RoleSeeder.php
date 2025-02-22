<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'employee']
        ]);

        \App\Models\User::create([
            'name' => 'Admin User',
            'email'=> 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);

        \App\Models\User::create([
            'name' => 'Employe User',
            'email'=> 'employe@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);
    }
}
