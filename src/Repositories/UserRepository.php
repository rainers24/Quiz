<?php

namespace Quiz\Repositories;


use Quiz\Models\UserModel;

class UserRepository
{

    /** @var UserModel[] */    //šis nozime, ka mes paradam, ka tas ir masivs
    private $users = [];

    private $idCounter = 0;

    public function getById(int $userId): UserModel
    {
        if (isset($this->users[$userId])) {
            return $this->users[$userId];
        }

        return new UserModel;
    }


    public function saveOrCreate(UserModel $user): UserModel {

      $existingUser = $this->getById($user->id);
      if (!$existingUser->isNew()){
          $this->idCounter += 1;
          $existingUser->id =$this->idCounter;
      }

      $existingUser->name = $user->name;
      $this->users[$existingUser->id] = $existingUser;

      return $existingUser;

        //check if user exists
        //if user exists ->edit name
        //if user not exist, create new
        //save

    }
    public function getAll() : array {
        return $this->users;

    }
}