<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semesters;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semesters = [
            '1st Semester',
            '2nd Semester',
        ];

        foreach ($semesters as $sem) {
            Semesters::firstOrCreate(['name' => $sem]);
        }
    }
}
