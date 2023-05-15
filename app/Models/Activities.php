<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'subjects_id',
        'grading_periods_id',
        'requirements_id',
        'total'

    ];

    public function requirements()
    {
        return $this->belongsTo(Requirements::class);
    }

    public function gradingPeriod()
    {
        return $this->belongsTo(GradingPeriod::class, 'grading_periods_id');
    }
    
}
