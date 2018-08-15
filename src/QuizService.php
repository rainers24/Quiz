<?php

namespace Quiz;

use Quiz\Models\AnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Models\UserAnswerModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;

class QuizService
{
    /** @var QuizRepository */
    private $quizes;
    /** @var UserRepository */
    private $users;
    /** @var UserAnswerRepository */
    private $userAnswers;
    private $userId;

    public function __construct(
        QuizService $quizService,
        QuizRepository $quizes,
        UserRepository $users,
        UserAnswerRepository $userAnswers
    ) {
        $this->quizService = $quizService;
        $this->quizes = $quizes;
        $this->users = $users;
        $this->userAnswers = $userAnswers;
    }

    /**
     * Get list of available quizes
     *
     * @return QuizModel[]
     */
    public function getQuizes(): array
    {
        return $this->quizes->getList();

    }

    /**
     * Register a new user
     *
     * @param string $name
     * @return UserModel
     */
    public function registerUser(string $name): UserModel
    {
        $user = new UserModel;
        $user->name = $name;
        return $this->users->saveOrCreate($user);
    }

    /**
     * Check if user exists in the system (is valid)
     *
     * @param int $userId
     * @return bool
     */
    public function isExistingUser($userId): bool
    {
        $user = $this->users->getById($userId);

        if ($user->isNew()) {
            return false;
        }

        return true;
    }


    /**
     * Get list of questions for a specific quiz
     *
     * @param $quizId
     * @return QuestionModel[]
     */

    public function getQuestions(int $quizId): array
    {
        return $this->quizes->getQuestions($quizId);
    }

    /**
     * Get list of available answers for this question
     *
     * @param int $questionId
     * @return AnswerModel[]
     */

    public function getAnswers(int $questionId): array
    {
        return $this->quizes->getAnswers($questionId);
    }

    /**
     * Submit current users answer
     *
     * @param int $userId
     * @param int $quizId
     * @param int $answerId
     * @internal param int $questionId
     */
    public function submitAnswer(int $userId, int $quizId, int $answerId)
    {
        $answeToSave = new UserAnswerModel;
        $answeToSave->userId = $userId;
        $answeToSave->quizId = $quizId;
        $answeToSave->answerId = $answerId;

         $this->userAnswers->saveAnswer($answeToSave);

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