<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class)
            ->withPivot('order')
            ->orderBy('order');
    }
}
