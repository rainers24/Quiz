<?php
//include_once '../vendor/autoload.php';
//
//use Quiz\Repositories\QuizRepository;
//use Quiz\Repositories\UserBaseRepository;
//
//$quizRepo = new QuizRepository;
//$repo = new UserBaseRepository;
//
//$repo ->connect();
//$data = $repo-> getbyId( '1');
//var_dump($data);
//
//$data = $repo->getbyCondition('id =2');
//
//var_dump($data);
//


use Quiz\src\Controllers\BaseController;

require_once '../src/bootstrap.php';

define('BASE_DIR', __DIR__ . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');
define('VIEW_DIR', SOURCE_DIR . '/views');

$requestUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$requestString = substr($requestUrl, strlen($baseUrl));

$urlParams = explode('/', $requestString);
$controllerName = ucfirst(array_shift($urlParams));
$controllerName = $controllerNamespace . ($controllerName ? $controllerName : 'Index') . 'Controller';

$actionName = strtolower(array_shift($urlParams));

$actionName = ($actionName ? $actionName : 'Index') . 'Action';

/** @var BaseController $controller */
$controller = new $controllerName;
$controller->handleCall($actionName);
