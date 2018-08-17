<?php

namespace Quiz\Controllers;

use Quiz\Models\UserModel;
use Quiz\Repositories\UserBaseRepository;

class AjaxController extends BaseAjaxController
{
    public function indexAction()
    {
        $repo = new UserBaseRepository();
        $user = new UserModel;
        $user->name = 'Rainers';
        $repo->save($user);

    }

    public function saveUserAction()
    {
        $userRepo = new UserBaseRepository();

        echo'halo halo ';
        $user = new UserModel(1 , 'Rainers');
        $userRepo->connect();
        $userRepo->save($user);
    }
}