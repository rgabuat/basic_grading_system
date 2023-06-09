<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subjects_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subjects::class,'subjects_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function requirements()
    {
        return $this->belongsTo(Requirements::class,'user_id');
    }

   
}
