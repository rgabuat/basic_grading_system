<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_id',
        'year_level_id',
        'semester_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function yearLevel()
    {
        return $this->belongsTo(Year_levels ::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semesters::class);
    }
}
