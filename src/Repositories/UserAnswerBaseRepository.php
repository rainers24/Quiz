<?php
/**
 * Created by PhpStorm.
 * User: rainerskniss
 * Date: 17/08/2018
 * Time: 1:14 PM
 */

namespace Quiz\Repositories;


use Quiz\Models\UserAnswerModel;

class UserAnswerBaseRepository extends BaseRepository
{

    /**
     * @return string
     */
    public static function modelName(): string
    {
        return UserAnswerModel::class;
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'user_answers';
    }
}