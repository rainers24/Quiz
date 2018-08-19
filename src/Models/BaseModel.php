<?php


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

    public function jsonSerialize()
    {
        return $this->attributes;
    }

    public function setAttributes(array $attributes = [])
    {

        foreach ($attributes as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }

        }

    }

}
