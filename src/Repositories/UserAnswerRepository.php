<?php
/**
 * Created by PhpStorm.
 * User: rainerskniss
 * Date: 14/08/2018
 * Time: 11:16 AM
 */

namespace Quiz\Repositories;

use Quiz\Models\UserAnswerModel;



class UserAnswerRepository
{
    /** @var UserAnswerModel[] */
    private $results = [];
    private $idCounter;
    private $userAnswers;


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






