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

    public function grade(array $answers)
    {
        $totalQuestions = $this->questions()->count();

        if ($totalQuestions === 0) {
            return [
                'score' => 0,
                'passed' => false,
                'message' => 'No questions found in this quiz.'
            ];
        }

        $correctAnswers = 0;

        foreach ($this->questions as $question) {
            if (isset($answers[$question->id]) && $answers[$question->id] == $question->correct_answer) {
                $correctAnswers++;
            }
        }

        $score = ($correctAnswers / $totalQuestions) * 100;
        $passed = $score >= 70; // Example passing score threshold

        return [
            'score' => $score,
            'passed' => $passed,
        ];
    }
}
