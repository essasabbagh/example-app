<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_attempt_id',
        'quiz_question_id',
        'selected_answer',
        'is_correct',
    ];

    public function quizAttempt()
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    public function quizQuestion()
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
