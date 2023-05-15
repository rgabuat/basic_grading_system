<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    use HasFactory;

    protected $fillable = [
        'students_id',
        'activity_id',
        'subjects_id',
        'score',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class,'students_id');
    }

    public function activity()
    {
        return $this->belongsTo(Activities::class,'activity_id');
    }

    public function subjects()
    {
        return $this->belongsTo(Subjects::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function gradingPeriod()
    {
        return $this->belongsTo(GradingPeriod::class);
    }
}
