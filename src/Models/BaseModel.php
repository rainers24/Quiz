<?php
/**
 * Created by PhpStorm.
 * User: rainerskniss
 * Date: 16/08/2018
 * Time: 4:02 PM
 */

namespace Quiz\Models;


abstract class BaseModel
{
    /**
     * @var bool
     */
    public $isNew = true;
    /**
     * @var array
     */
    public $attributes;
}