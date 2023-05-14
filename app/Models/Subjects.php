<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'courses_id',
        'year_level_id',
        'semester_id'
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

    public function yearLevel()
    {
        return $this->belongsTo(Year_levels ::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semesters::class);
    }


    public function TeacherSubject()
    {
        return $this->hasMany(TeacherSubject::class);
    }

    public function scopeWhereDoesntHave($query, $relation)
    {
        $relatedTable = $this->$relation()->getRelated()->getTable();

        return $query->whereDoesntHaveSubquery($relation, function ($query) use ($relatedTable) {
            $query->from($relatedTable);
        });
    }
}
