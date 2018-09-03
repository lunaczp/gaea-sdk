<?php
namespace Gaea\Core;

use Gaea\Exception\GaeaException;

class ObjPool {

    public static function get($class) {
        if (empty($class)) {
            throw new GaeaException("Class name is empty");
        }

        static $pool = [];

        if(isset($pool[$class])) {
            return $pool[$class];
        }

        //new one
        if (!class_exists($class)) {
            throw new GaeaException("Class not exist:" .$class);
        }

        $pool[$class] = new $class();
        return $pool[$class];
    }
}
