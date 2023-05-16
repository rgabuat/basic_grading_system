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
use Mail;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailSentNotification;
use Illuminate\Support\Facades\Auth;


class SubjectsStudents extends Page
{
    protected static string $resource = StudentsResource::class;

    protected static string $view = 'filament.resources.students-resource.pages.subjects';

    public $record;
    public $loading = false;


    public function mount($record){

        $students = Students::find($record);
        $this->record = $record;

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

    public function sendEmail()
    {
        $this->loading = true;
        $students = Students::find($this->record);

        $subjects = Subjects::where('courses_id', $students->courses_id)->get();

        $table = '<table>';
$table .= '<thead><tr><th>Subject</th>';

if (!is_null($subjects)) {
    $gradingPeriods = GradingPeriod::get();
    foreach ($gradingPeriods as $grading) {
        $table .= '<th>' . $grading->name . '</th>';
    }

    $table .= '<th>Final Grade</th>';
    $table .= '<th>Remarks</th>';
    $table .= '</tr></thead><tbody>';

    foreach ($subjects as $subject) {
        $table .= '<tr>';
        $table .= '<td>' . $subject->name . '</td>';

        $finalGrade = 0;

        foreach ($gradingPeriods as $grading) {
            $requirements = Requirements::where('subjects_id', $subject->id)->get();
            $gradingPeriodTotal = 0;

            foreach ($requirements as $requirements) {
                $requirementsTotal = 0;
                $requirementsScore = 0;
                $requirementsPercentage = 0;
                $activities = Activities::where('requirements_id', $requirements->id)
                    ->where('grading_periods_id', $grading->id)
                    ->get();

                foreach ($activities as $activities) {
                    $requirementsTotal += $activities->total;

                    $grades = Grades::where('activity_id', $activities->id)->get();

                    foreach ($grades as $grades) {
                        $requirementsScore += $grades->score;
                    }
                }

                $requirementsPercentage = ($requirementsScore / $requirementsTotal) * ($requirements->percentage / 100);
                $gradingPeriodTotal += $requirementsPercentage;
            }

            $table .= '<td>' . ($gradingPeriodTotal * 100) . '</td>';

            if ($grading->name == 'Finals') {
                $finalGrade += ($gradingPeriodTotal * 100) * 0.4; // Finals weight is 40%
            } else {
                $finalGrade += ($gradingPeriodTotal * 100) * 0.3; // Prelim and Midterm weight is 30% each
            }
        }

        $table .= '<td>' . $finalGrade . '</td>';
        $table .= '<td>' . ($finalGrade > 75 ? 'Passed' : 'Failed') . '</td>';

        $table .= '</tr>';
    }

    $table .= '</tbody></table>';

    // Output or send the $table variable as needed
    echo $table;
} else {
    // Handle the case when $subjects is null
    echo 'No subjects found.';
}

        $mailData = [
            'title' => 'Student Grades',
            'body' => $table,
        ];

        Mail::to($students->parent_email)->send(new DemoMail($mailData));

        session()->flash('success', 'Email sent successfully');
        $this->loading = false;
    }

}

