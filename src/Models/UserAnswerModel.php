<?php

namespace Quiz\Models;

class UserAnswerModel extends BaseModel
{
    public $userId;
    public $quizId;
    public $answerId;
    public $createdAt;
    public $questionId;


    /**
     * UserAnswerModel constructor.
     * @param int $id
     * @param int $userId
     * @param int $quizId
     * @param int $answerId
     */

    public function __construct(int $id = 0, int $userId = 0, int $quizId = 0, int $answerId = 0)
    {
        $this->userId = $userId;
        $this->quizId = $quizId;
        $this->answerId = $answerId;
    }
}
