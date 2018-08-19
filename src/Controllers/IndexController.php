<?php
namespace Quiz\Controllers;
use Quiz\Repositories\UserBaseRepository;
class IndexController extends BaseController
{
    /** @var UserBaseRepository */
    protected $userRepository;
    public function __construct(UserBaseRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function indexAction()
    {
        $user = $this->userRepository->one();
        if ($user === null) {
            // TODO 404?
        }
        return $this->render('index', compact('user'));
    }
}