<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomLecture extends Model
{
    use HasFactory;

    protected $table = 'classroom_lecture';
    protected $fillable = ['classroom_id', 'lecture_id', 'order'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}
