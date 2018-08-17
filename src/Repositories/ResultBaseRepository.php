<?php
/**
 * Created by PhpStorm.
 * User: rainerskniss
 * Date: 17/08/2018
 * Time: 1:15 PM
 */

namespace Quiz\Repositories;


use Quiz\Models\ResultModel;

class ResultBaseRepository extends BaseRepository
{

    /**
     * @return string
     */
    public static function modelName(): string
    {

        return ResultModel::class;
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'results';
    }
}