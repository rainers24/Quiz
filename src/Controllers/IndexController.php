<?php

namespace Quiz\Controllers;
use Quiz\Repositories\UserRepository;

class IndexController extends BaseController
{
    public function indexAction(){
        echo 'ok';
        $repo = new UserRepository();
        $user = $repo->getById(1);

        return $this->render('index', compact('user'));
    }

}