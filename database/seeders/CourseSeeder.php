<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Courses;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $courses = [[
            'name' =>'Bachelor of Science in Nursing',
            'abbv' => 'BSN',
            ],
            [
            'name' =>'Bachelor of Science in Informations and Technology',
            'abbv' => 'BSIT',
            ],
        ];

        foreach ($courses as $course) {
            Courses::firstOrCreate($course);
        }
    }
}
