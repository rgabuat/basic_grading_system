<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GradingPeriod;

class GradingPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $yearLvls = [
            'Prelim',
            'Midterm',
            'Finals',
        ];

        foreach ($yearLvls as $yearLvl) {
            GradingPeriod::firstOrCreate(['name' => $yearLvl]);
        }
    }
}
