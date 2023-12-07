<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
            $roles = [
                [
                    'id' => 1,
                    'slug' => 'admin',
                    'name' => 'Admin',
                    'permissions' => '',
                    'status' => '', 
                ],
                [
                    'id' => 2,
                    'slug' => 'student',
                    'name' => 'Student',
                    'permissions' => '',
                    'status' => '', 
                ],
                [
                    'id' => 3,
                    'slug' => 'instructor',
                    'name' => 'Instructor',
                    'permissions' => '',
                    'status' => '', 
                ],
                // You can add more roles as needed
            ];
    
            foreach ($roles as $role) {
                Role::create($role);
            } 
    }
}
