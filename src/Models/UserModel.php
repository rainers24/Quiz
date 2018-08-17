<?php

namespace Quiz\Models;


class UserModel extends BaseModel
{
    /** @var int */
    public $id;
    /** @var string */
    public $name;


    public function __construct(int $id = 0, string $name = '')
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function isNew()
    {
        return $this->id == 0;
    }
}