<?php

namespace Quiz\Controllers;



class BaseAjaxController extends BaseController
{
    public function callAction($action)
    {
        $content = static::$action();

        echo json_encode(['result' => $content]);

    }
}