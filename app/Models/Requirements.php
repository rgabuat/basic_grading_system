<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirements extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'percentage',
        'subjects_id'
    ];


    public function TeacherSubject()
    {
        return $this->hasMany(TeacherSubject::class);
    }
}
