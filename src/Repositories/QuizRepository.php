<?php
/**
 * Created by PhpStorm.
 * User: rainerskniss
 * Date: 17/08/2018
 * Time: 2:33 PM
 */

namespace Quiz\Repositories;


use Quiz\Models\QuizModel;

class QuizRepository extends BaseRepository
{

    /*** @return string */
    public static function modelName(): string
    {
        return QuizModel::class;
    }

    /*** @return string */
    public static function getTableName(): string
    {
        return 'quizzes';
    }
}