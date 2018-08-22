<?php

namespace Quiz;

use Exception;
use Quiz\Models\AnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Models\UserAnswerModel;
use Quiz\Models\User;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;


class QuizService
{
    private $quizes;
    private $users;
    private $userAnswers;
    private $userId;

    /**
     * QuizService constructor.
     * @param QuizRepository $quizes
     * @param UserRepository $users
     * @param UserAnswerRepository $userAnswers
     */
    public function __construct(
        QuizRepository $quizes,
        UserRepository $users,
        UserAnswerRepository $userAnswers
    ) {
        $this->quizes = $quizes;
        $this->users = $users;
        $this->userAnswers = $userAnswers;
    }

    /**
     * Get list of available quizes
     *
     * @return QuizModel[]
     */
    public function all(): array
    {
        return $this->quizes->all();

    }


    public function getQuestions(int $quizId): array
    {
        return $this->quizes->getQuestions($quizId);
    }

    /**
     * Get list of available answers for this question
     *
     * @param int $questionid
     * @return AnswerModel[]
     */

    public function getAnswers(int $questionid): array
    {
        return $this->quizes->getAnswers($questionid);
    }

    /**
     * Submit current users answer
     *
     *
     * @param int $userId
     * @param int $quizId
     * @param int $answerId
     * @return UserAnswerModel
     * @throws Exception
     * @internal param int $questionId
     */
    public function submitAnswer(int $userId, int $quizId, int $answerId)
    {
        $answeToSave = new UserAnswerModel;
        $answeToSave->userId = $userId;
        $answeToSave->quizId = $quizId;
        $answeToSave->answerId = $answerId;

        if (!$this->isExistingUser($userId)) {
            throw new Exception('User does not exist');
        }
        return $this->userAnswers->saveAnswer($answeToSave);

    }

    /**
     * Check if user has answered all questions for this quiz (correct or incorrect)
     *
     * @param int $userId
     * @param int $quizId
     * @return bool
     */
    public function isQuizCompleted(int $userId, int $quizId): bool
    {
        $userAnswers = $this->userAnswers->getAnswers($userId, $quizId);
        $quizQuestions = $this->quizes->getQuestions($quizId);
        if (count($userAnswers) != count($quizQuestions)) {
            return false;
        }
        return true;
    }

    /**
     * Get score in the quiz in percentage round(right answers / answer count * 100)
     *
     * @param int $userId
     * @param int $quizId
     * @return int 0-100
     */
    public function getScore(int $userId, int $quizId): int
    {
        //dalīsim pareizās atbildes ar visām

        $result = 0;
        $userAnswers = $this->userAnswers->getAnswers($userId, $quizId);
        $quizQuestionCount = count($this->quizes->getQuestions($quizId)); // iegūstam skaitu visiem question
        foreach ($userAnswers as $userAnswer) {
            if ($this->quizes->isAnswerCorrect($userAnswer->id)) {
                $result++;
            }
        }
        return round(($result / $quizQuestionCount) * 100);
    }


}