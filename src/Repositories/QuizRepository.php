<?php

namespace Quiz\Repositories;


use Quiz\Models\AnswerModel;
use Quiz\Models\QuestionModel;
use quiz\Models\QuizModel;


class QuizRepository
{
    /** @var QuizModel[] */
    private $quizes = [];
    /** @var QuestionModel[] */
    private $questions = [];
    /** @var AnswerModel[] */
    private $answers = [];


    public function addQuiz(QuizModel $quiz)
    {
        return $this->quizes[] = $quiz;
    }

    public function getList(): array
    {
        return $this->quizes;

    }

    public function getAnswers(int $questionid): array
    {
        $answers = [];
        foreach ($this->answers as $answer) {
            if ($answer->questionid == $questionid) {
                $answers[] = $answer;
            }
        }
        return $answers;

    }

    public function getQuestions(int $quizId): array
    {
        $questions = [];

        foreach ($this->questions as $question) {
            if ($question->quizid == $quizId) {
                $questions[] = $question;
            }
        }
        return $questions;
    }

    public function addQuestion(QuestionModel $question)
    {
        $this->questions[] = $question;
    }

    public function addAnswers(AnswerModel $answer)
    {
        $this->answers[] = $answer;
    }

    public function getById(int $quizId): QuizModel
    {
        if(isset($this->quizes[$quizId])){
            return $this->quizes[$quizId];
        }
        return new QuizModel; // Returns empty model
    }

    public function isAnswerCorrect(int $answerId): bool
    {
        foreach($this->answers as $answer){
            if($answer->id == $answerId)
            {
                if($answer->isCorrect == true)
                {
                    return true;
                }
            }
        }

        return false;
    }
}