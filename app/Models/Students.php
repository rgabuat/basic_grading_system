<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_id',
       
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class);
    }
}
