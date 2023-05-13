<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Year_levels;

class YearLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $yearLvls = [
            '1st Year',
            '2nd Year',
            '3rd Year',
            '4th Year',
        ];

        foreach ($yearLvls as $yearLvl) {
            Year_levels::firstOrCreate(['name' => $yearLvl]);
        }
    }
}
