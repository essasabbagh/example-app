<?php
namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizAttemptController extends Controller
{
    public function store(Request $request, Quiz $quiz)
    {
        $user = $request->user();

        // Create a quiz attempt
        $quizAttempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'user_id' => $user->id,
        ]);

        $questions = QuizQuestion::where('quiz_id', $quiz->id)->get();

        foreach ($questions as $question) {
            $selectedAnswer = $request->input('answers.' . $question->id);
            $isCorrect = $selectedAnswer == $question->correct_answer;

            QuizAnswer::create([
                'quiz_attempt_id' => $quizAttempt->id,
                'quiz_question_id' => $question->id,
                'selected_answer' => $selectedAnswer,
                'is_correct' => $isCorrect,
            ]);
        }

        // Calculate the score
        $score = QuizAnswer::where('quiz_attempt_id', $quizAttempt->id)
                            ->where('is_correct', true)
                            ->count();

        return response()->json(['message' => 'Quiz completed', 'score' => $score]);
    }

    public function show(QuizAttempt $quizAttempt)
    {
        return response()->json($quizAttempt->load('answers.quizQuestion'));
    }
}
