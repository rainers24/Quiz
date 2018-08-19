<?php

namespace Quiz;

use Exception;
use Quiz\Models\AnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Models\UserAnswerModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\QuizBaseRepository;
use Quiz\Repositories\UserAnswerBaseRepository;
use Quiz\Repositories\UserBaseRepository;


class QuizService
{
    /** @var QuizBaseRepository */
    private $quizes;
    /** @var UserBaseRepository */
    private $users;
    /** @var UserAnswerBaseRepository */
    private $userAnswers;
    private $userId;

    /**
     * QuizService constructor.
     * @param QuizBaseRepository $quizes
     * @param UserBaseRepository $users
     * @param UserAnswerBaseRepository $userAnswers
     */
    public function __construct(
        QuizBaseRepository $quizes,
        UserBaseRepository $users,
        UserAnswerBaseRepository $userAnswers
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
    public function getQuizes(): array
    {
        return $this->quizes->getList();

    }

    /**
     * Register a new user
     *
     * @param string $name
     * @return UserModel
     * @throws Exception
     */
    public function registerUser(string $name): UserModel
    {
        $user = new UserModel;
        $user->name = $name;
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            throw new Exception ("Only letters and white space allowed");
        }
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
       return  $this->userAnswers->saveAnswer($answeToSave);

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