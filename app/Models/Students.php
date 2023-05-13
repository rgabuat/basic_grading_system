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
        'mname',
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
        
    ];


    public function courses()
    {
        return $this->hasOne(Student_semester::class);
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class);
    }

    public function studentSemester(){
        return $this->hasOne(Student_semester::class);
    }
}
