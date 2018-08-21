<?php
namespace Quiz\Models;

class AnswerModel extends BaseModel
{

    /**
     * @var
     */
    public $questionid;
    /**
     * @var
     */
    public $answer;
    /**
     * @var
     */
    public $isCorrect;
}