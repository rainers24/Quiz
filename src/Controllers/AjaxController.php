<?php
namespace Quiz\Controllers;
use Quiz\Models\UserModel;
use Quiz\Repositories\UserBaseRepository;
class AjaxController extends BaseAjaxController
{
    /** @var UserBaseRepository */
    protected $userRepository;
    public function __construct(UserBaseRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function saveUserAction()
    {
        $name = $this->post->get('name');
        /** @var UserModel $user */
        $user = $this->userRepository->create();
        $user->name = $name;
        $this->userRepository->save($user);
        return $user;
    }
}