<?php


namespace Quiz\Repositories;


use Quiz\Models\AnswerModel;

class AnswerRepository extends BaseRepository
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