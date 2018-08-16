<?php
include_once '../vendor/autoload.php';

use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserDatabaseRepository;

$quizRepo = new QuizRepository;
$repo = new UserDatabaseRepository;

$repo ->connect();
$data = $repo-> getbyId( '1');
var_dump($data);

$data = $repo->getbyCondition('id =2');

var_dump($data);

