<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            ['name' => '3rd', 'number' => 3],
            ['name' => '4th', 'number' => 4],
            ['name' => '5th', 'number' => 5],
            ['name' => '6th', 'number' => 6],
            ['name' => '7th', 'number' => 7],
            ['name' => '8th', 'number' => 8],
            ['name' => '9th', 'number' => 9],
            ['name' => '10th', 'number' => 10],
            ['name' => '11th', 'number' => 11],
            ['name' => '12th', 'number' => 12],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
