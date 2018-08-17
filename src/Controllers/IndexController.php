<?php

namespace Quiz\Controllers;
use Quiz\Repositories\UserBaseRepository;

class IndexController extends BaseController
{
    public function indexAction(){
        echo 'ok';
        $repo = new UserBaseRepository;
        $user = $repo->getById(1);

        return $this->render('index', compact('user'));
    }

}