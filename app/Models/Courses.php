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
        return $this->hasOne(Student_semester::class);
    }

    
}
