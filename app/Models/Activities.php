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
        'user_id',
        'subjects_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function requirements()
    {
        return $this->belongsTo(Requirements::class);
    }
    
}
