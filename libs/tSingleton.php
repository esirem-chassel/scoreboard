<?php

/**
 *
 * @author 
 */
trait tSingleton {
    protected static $instance = null;
    public static function getInstance(): self {
        if(static::$instance === null) {
            $cls = get_called_class();
            static::$instance = new $cls();
        }
        return static::$instance;
    }
    
    protected function __construct() {}
}
