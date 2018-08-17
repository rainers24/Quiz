<?php
/**
 * Created by PhpStorm.
 * User: rainerskniss
 * Date: 17/08/2018
 * Time: 1:11 PM
 */

namespace Quiz\Repositories;


use Quiz\Models\AnswerModel;

class AnswerBaseRepository extends BaseRepository
{

    /**
     * @return string
     */
    public static function modelName(): string
    {
        return AnswerModel::class;
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'answers';
    }
}