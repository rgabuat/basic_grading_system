<?php

namespace App\Filament\Resources\StudentsResource\Pages;

use App\Filament\Resources\StudentsResource;
use Filament\Resources\Pages\Page;
use App\Models\Students;
use App\Models\Subjects;
use App\Models\GradingPeriod;
use App\Models\Requirements;
use App\Models\Activities;
use App\Models\Grades;
use Illuminate\Support\Facades\Storage;





class SubjectsStudents extends Page
{
    protected static string $resource = StudentsResource::class;

    protected static string $view = 'filament.resources.students-resource.pages.subjects';

    public function mount($record){

        $students = Students::find($record);

        $subjects = Subjects::where('courses_id',$students->courses_id)->get();
        $this->gradingPeriod = GradingPeriod::get();

        foreach ($subjects as $key => $subject) {
            $subject->gradingPeriod = GradingPeriod::get();

            foreach ($subject->gradingPeriod as $gp => $grading) {
                $grading->requirements = Requirements::where('subjects_id', $subject->id)->get();
                $gradingPeriodTotal = 0;
        
                foreach ($grading->requirements as $keyrequirements => $requirements) {
                    $requirementsTotal = 0;
                    $requirementsScore = 0;
                    $requirementsPercentage = 0;
                    $requirements->activities = Activities::where('requirements_id', $requirements->id)->where('grading_periods_id', $grading->id)->get();
        
                    foreach ($requirements->activities as $key => $activities) {
                        $requirementsTotal += $activities->total;
                        $requirements->total = $requirementsTotal;
        
                        $activities->grades = Grades::where('activity_id', $activities->id)->get();
        
                        foreach ($activities->grades as $key => $grades) {
                            $activities->score = $grades->score;
                            $requirementsScore += $grades->score;
                            $requirements->score = $requirementsScore;
                            $requirementsPercentage = ($requirements->score / $requirements->total) * ($requirements->percentage / 100);
                            $requirements->totalPercentage = $requirementsPercentage;
                        }
                    }
        
                    $gradingPeriodTotal += $requirementsPercentage;
                    $grading->total = $gradingPeriodTotal;
                }
        
               
            }
            $this->subjects=$subjects;
            // dd($subjects);
        }
    }

    public function export()
    {
        return Storage::disk('exports')->download('export.csv');
    }

}

