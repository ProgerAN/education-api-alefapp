<?php

namespace App\Models;

use App\Http\Requests\StudentRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'classroom_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class, 'classroom_lecture', 'classroom_id', 'lecture_id');
    }
}
