<?php
/**
 * Created by PhpStorm.
 * User: rainerskniss
 * Date: 17/08/2018
 * Time: 1:34 PM
 */

namespace Quiz\Repositories;


use Quiz\Models\QuestionModel;

class QuestionBaseRepository extends BaseRepository
{

    /*** @return string */
    public static function modelName(): string
    {
        return QuestionModel::class;
    }

    /*** @return string */
    public static function getTableName(): string
    {
        return 'questions';
    }
}