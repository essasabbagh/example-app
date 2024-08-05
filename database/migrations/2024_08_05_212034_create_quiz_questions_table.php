<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->text('question');
            $table->text('options'); // Can be stored as JSON or comma-separated string
            $table->string('correct_answer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_questions');
    }
};
