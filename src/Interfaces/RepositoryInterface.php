<?php
namespace Quiz\Interfaces;

interface RepositoryInterface
{
    /**
     * @return string
     */
    public static function modelName(): string;


    /**
     * @return string
     */
    public static function getTableName(): string;

}