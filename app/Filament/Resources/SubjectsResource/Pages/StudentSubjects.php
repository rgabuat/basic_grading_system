<?php

namespace App\Filament\Resources\SubjectsResource\Pages;

use App\Filament\Resources\SubjectsResource;
use Filament\Resources\Pages\Page;
use App\Models\Grades;
use App\Models\GradingPeriod;
use App\Models\Requirements;
use App\Models\Activities;


use App\Models\Students;
use Illuminate\Database\Eloquent\Builder;

class StudentSubjects extends Page
{
    protected static string $resource = SubjectsResource::class;

    protected static string $view = 'filament.resources.subjects-resource.pages.student-subjects';

    public $subjectId;
    public $grades;

 
    public function mount($record)
    {
        $id=$record;
        $students = Students::whereHas('courses.subjects', function (Builder $query) use ($record) {
            $query->where('id', $record);
        })->get();

        foreach ($students as $keyS => $student) {
            $student->gradingPeriod = GradingPeriod::get();
            $studentTotal = 0;
            foreach ($student->gradingPeriod as $gp => $grading) {
                $grading->requirements = Requirements::where('subjects_id', $record)->get();
                $gradingPeriodTotal = 0;
        
                foreach ($grading->requirements as $keyrequirements => $requirements) {
                    $requirementsTotal = 0;
                    $requirementsScore = 0;
                    $requirementsPercentage = 0;
        
                    $requirements->activities = Activities::where('requirements_id', $requirements->id)->where('grading_periods_id', $grading->id)->get();
        
                    foreach ($requirements->activities as $key => $activities) {
                        $requirementsTotal = $requirementsTotal + $activities->total;
                        $requirements->total = $requirementsTotal;
        
                        $activities->grades = Grades::where('activity_id', $activities->id)->get();
        
                        foreach ($activities->grades as $key => $grades) {
                            $activities->score = $grades->score;
                            $requirementsScore = $requirementsScore + $grades->score;
                            $requirements->score = $requirementsScore;
                            $requirementsPercentage = ($requirements->score / $requirements->total) * ($requirements->percentage / 100);
                            $requirements->totalPercentage = $requirementsPercentage;
                        }
                    }
        
                    $gradingPeriodTotal = $gradingPeriodTotal + $requirementsPercentage;
                    $grading->total = $gradingPeriodTotal;
                }
                $studentTotal = $studentTotal +$gradingPeriodTotal;
                $student->total = $studentTotal;

            }
        }
        $this->students=$students;
        //dd($students);
    }





}