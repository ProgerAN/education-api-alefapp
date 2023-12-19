<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = ['topic', 'description'];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'classroom_lecture', 'classroom_id', 'lecture_id');
    }
}
