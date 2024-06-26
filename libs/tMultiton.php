<?php

/**
 *
 * @author 
 */
trait tMultiton {
    protected static $instances = [];
    public static function getInstance(string $profile): self {
        if(!array_key_exists($profile, static::$instances)) {
            $cls = get_called_class();
            static::$instances[$profile] = new $cls($profile);
        }
        return static::$instances[$profile];
    }
    
    protected string $profile;
    
    protected function __construct($profile) { $this->profile = $profile; }
}
