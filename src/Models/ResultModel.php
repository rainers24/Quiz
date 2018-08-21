<?php
/**
 * Created by PhpStorm.
 * User: rainerskniss
 * Date: 17/08/2018
 * Time: 1:16 PM
 */

namespace Quiz\Models;


class ResultModel extends BaseModel
{
    /** @var $userId */
    public $userId;
    /** @var $quizId */
    public $quizId;
    /** @var $score */
    public $score;
    /** @var $createdAt */
    public $createdAt;
    /** @var $ip */
    public $ip;


}