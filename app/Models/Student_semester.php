<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'semester_id',
        'year_level_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
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
