<?php

namespace Quiz\Repositories;

use Quiz\Models\UserAnswerModel;



class UserAnswerRepository
{
    /** @var UserAnswerModel[] */
    private $results = [];
    private $idCounter;


    public function saveAnswer(UserAnswerModel $userAnswer): UserAnswerModel
    {
        $this->idCounter++;
        $userAnswer->id = $this->idCounter;
        $this->results[] = $userAnswer;
        return $userAnswer;
    }

    public function getAnswers(int $userId, int $quizId): array
    {
        $userAnswers = [];

        foreach ($this->results as $result) {
            if ($result->quizId == $quizId && $result->userId == $userId) {
                $userAnswers[] = $result;
            }
        }

        return $userAnswers;
    }

}






