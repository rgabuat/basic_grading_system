<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'course_id',
        'gender',
        'dob',
        'email',
        'address',
        'phone_number',
        'parent_name',
        'parent_email',
        'parent_address',
        'parent_phone_number',
        'courses_id',
        'year_level_id',
        'semester_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsTo(Courses::class);
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class);
    }

    public function gradingPeriod()
    {
        return $this->belongsTo(GradingPeriod::class);
    }

    public function studentSemester(){
        return $this->hasOne(Student_semester::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subjects::class);
    }
}
