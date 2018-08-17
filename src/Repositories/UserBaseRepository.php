<?php
/**
 * Created by PhpStorm.
 * User: rainerskniss
 * Date: 16/08/2018
 * Time: 12:42 PM
 */

namespace Quiz\Repositories;


use Quiz\Models\UserModel;

class UserBaseRepository extends BaseRepository
{
   public static function modelName(): string
   {
return UserModel::class;
   }

    public static function getTableName(): string
    {
        return 'users';
    }
}
