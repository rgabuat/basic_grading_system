<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','abbv'
    ];

    public function Student_semester()
    {
        return $this->belongsToMany(Student_semester::class);
    }

    public function students()
    {
        return $this->hasMany(Students::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subjects::class);
    }

    
}
