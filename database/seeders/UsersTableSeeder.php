<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'role_id' => 1,
            'first_name' => 'Kenny',
            'last_name' => 'Johnson',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123456789'), // Hashed password
            'gender' => 'male',
            'country' => 'Kuwait',
            'timezone' => 'Asia/Dubai',
            'dob' => '1990-06-08', 
            'contact' => '+923067277231',
            'status' => 0,
            'registration_type' => 0, 
            // You can add more fields as needed
        ]);
        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
