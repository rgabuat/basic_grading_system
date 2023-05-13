<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_semester extends Model
{
    use HasFactory;

    protected $table ="student_semesters";

    protected $fillable = [
        'students_id',
        'courses_id',
        'semester_id',
        'year_level_id',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class);
    }

    public function courses()
    {
        return $this->belongsTo(Courses::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function yearLevel()
    {
        return $this->belongsTo(Year_levels::class);
    }
}
