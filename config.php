<?php
    spl_autoload_register(function ($cls) {
        $fn = __DIR__.'/libs/'.$cls.'.php';
        if(file_exists($fn)) {
            require_once $fn;
        }
    });
    
    define('SQL_HOST', 'localhost');
    define('SQL_USER', 'scoreboard');
    define('SQL_PWD', 'scoreboard');
    define('SQL_DB', 'scoreboard');
    
    
    
    