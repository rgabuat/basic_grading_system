<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subjects;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subjects = [[
            'name' =>'Math',
            'code' => 'M01',
            'courses_id' => '1',
            'semester_id' => '1',
            'year_level_id' => '1'
            ],
            [
            'name' =>'Science',
            'code' => 'S01',
            'courses_id' => '2',
            'semester_id' => '2',
            'year_level_id' => '2'
            ],
        ];

        foreach ($subjects as $subject) {
            Subjects::firstOrCreate($subject);
        }
    }
}
