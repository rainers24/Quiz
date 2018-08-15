<?php

namespace Quiz\Tests;

use Quiz\Models\QuestionModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserRepository;

class ExampleTest extends \PHPUnit\Framework\TestCase
{
    public function testTrue()
    {
        self::assertTrue(true);
    }

    public function testUserCreation()
    {
        $repo = new UserRepository;

        // Add new user

        $user = new UserModel;
        $user->name = 'Uldis';

        $userCreated = $repo->saveOrCreate($user);
        self::assertTrue($userCreated->isNew(), 'user not new');
        self::assertEquals($user->name, $userCreated->name, 'name');
    }

    public function testnameedit()
    {
        $repo = new UserRepository;

        //add new user
        $user = new UserModel;
        $user->name = 'Rainers';

        $saveduser = $repo->saveOrCreate($user);
        $saveduser->name = 'Jānis';

        $editeduser = $repo->saveOrCreate($user);
        self::assertEquals($saveduser->name, $editeduser->name, 'name is saved');
        self::assertEquals($saveduser->id, $editeduser->id, 'names match');
    }


}

