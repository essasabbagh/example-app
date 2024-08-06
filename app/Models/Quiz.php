<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{

    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'quiz_attempts')
            ->withPivot('score')
            ->withTimestamps();
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
