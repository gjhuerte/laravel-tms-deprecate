<?php

namespace App\Enumerables;

use App\Enumerables\BaseEnum;

class BaseEnum implements BaseEnumInterface
{

    /**
     * List all the constants for the current class
     *
     * @return mixed
     */
    public static function getConstants()
    {
        $class = new ReflectionClass(__CLASS__);
        
        return $class->getConstants();
    }
}
